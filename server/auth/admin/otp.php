<?php
/**
 * server/auth/otp.php
 * Shared helpers: secure session, CSRF, login throttling, OTP send/verify, page gate.
 *
 * One-time SQL (login throttling):
 *   CREATE TABLE admin_login_attempts (
 *     id INT AUTO_INCREMENT PRIMARY KEY,
 *     ip VARCHAR(45) NOT NULL,
 *     attempted_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
 *     INDEX (ip, attempted_at)
 *   );
 */

const OTP_TTL                = 600;    // code valid for 10 minutes
const OTP_MAX_ATTEMPTS       = 5;      // wrong guesses before the code is destroyed
const OTP_RESEND_COOLDOWN    = 60;     // seconds between sends
const OTP_MAX_SENDS_PER_HOUR = 5;
const ADMIN_ABSOLUTE_TTL     = 28800;  // 8h max session
const ADMIN_IDLE_TTL         = 1800;   // 30 min inactivity
const LOGIN_MAX_FAILS        = 5;      // per IP, per 15 minutes

// ---------------------------------------------------------------
//  Session / headers
// ---------------------------------------------------------------
function admin_session_start(): void
{
    if (session_status() === PHP_SESSION_ACTIVE) {
        return;
    }
    ini_set('session.use_strict_mode', '1');
    ini_set('session.use_only_cookies', '1');
    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => '/',
        'secure'   => !empty($_SERVER['HTTPS']),
        'httponly' => true,
        'samesite' => 'Strict',
    ]);
    session_start();
}

function admin_security_headers(): void
{
    header('Cache-Control: no-store, no-cache, must-revalidate');
    header('Pragma: no-cache');
    header('X-Frame-Options: DENY');
    header('X-Content-Type-Options: nosniff');
    header('Referrer-Policy: same-origin');
}

function admin_base_url(): string
{
    // Assumes $domain (from connection.php) is the site root, e.g. https://example.com/
    return rtrim($GLOBALS['domain'] ?? '/', '/') . '/admin/';
}

function admin_redirect(string $url): void
{
    header('Location: ' . $url);
    exit;
}

function admin_logout(): void
{
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $p = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $p['path'], $p['domain'], $p['secure'], $p['httponly']);
    }
    session_destroy();
}

// ---------------------------------------------------------------
//  CSRF
// ---------------------------------------------------------------
function csrf_token(): string
{
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}

function csrf_field(): string
{
    return '<input type="hidden" name="csrf" value="' . htmlspecialchars(csrf_token(), ENT_QUOTES) . '">';
}

function csrf_check($token): bool
{
    return !empty($_SESSION['csrf']) && is_string($token) && hash_equals($_SESSION['csrf'], $token);
}

// ---------------------------------------------------------------
//  Login throttling (per IP, stored in DB so clearing cookies doesn't reset it)
// ---------------------------------------------------------------
function login_is_locked(mysqli $db, string $ip): bool
{
    $s = $db->prepare("SELECT COUNT(*) FROM admin_login_attempts WHERE ip = ? AND attempted_at > (NOW() - INTERVAL 15 MINUTE)");
    $s->bind_param('s', $ip);
    $s->execute();
    $s->bind_result($n);
    $s->fetch();
    $s->close();
    return $n >= LOGIN_MAX_FAILS;
}

function login_record_failure(mysqli $db, string $ip): void
{
    $s = $db->prepare("INSERT INTO admin_login_attempts (ip) VALUES (?)");
    $s->bind_param('s', $ip);
    $s->execute();
    $s->close();
}

function login_clear_failures(mysqli $db, string $ip): void
{
    $s = $db->prepare("DELETE FROM admin_login_attempts WHERE ip = ?");
    $s->bind_param('s', $ip);
    $s->execute();
    $s->close();
}

// ---------------------------------------------------------------
//  OTP
// ---------------------------------------------------------------
function mask_email(string $email): string
{
    [$user, $host] = array_pad(explode('@', $email, 2), 2, '');
    return substr($user, 0, 1) . str_repeat('*', max(2, strlen($user) - 1)) . '@' . $host;
}

/** @return array{0:bool,1:string} */
function admin_otp_send(mysqli $db, int $adminId): array
{
    require_once __DIR__ . '/../../../mailer/index.php';
    require_once __DIR__ . '/../../../admin/reach/email_template.php';

    $now   = time();
    $sends = array_values(array_filter($_SESSION['otp_sends'] ?? [], fn($t) => $t > $now - 3600));

    if ($sends && ($now - max($sends)) < OTP_RESEND_COOLDOWN) {
        $wait = OTP_RESEND_COOLDOWN - ($now - max($sends));
        return [false, "Please wait {$wait}s before requesting another code."];
    }
    if (count($sends) >= OTP_MAX_SENDS_PER_HOUR) {
        return [false, 'Too many codes requested. Try again later.'];
    }

    $stmt = $db->prepare("SELECT auth_email FROM admin WHERE id = ? LIMIT 1");
    $stmt->bind_param('i', $adminId);
    $stmt->execute();
    $stmt->bind_result($email);
    $stmt->fetch();
    $stmt->close();

    if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return [false, 'No valid auth email is configured for this account.'];
    }

    unset($_SESSION['otp']); // any previous code dies the moment a new one is requested

    $code    = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    $subject = 'Your admin verification code';
    $body    = "Your one-time verification code is:\n\n**{$code}**\n\nThis code expires in 10 minutes. If you did not just sign in, change your password immediately.";
    $html    = buildEmailHtml($subject, $body, 'Admin');

    if (!smtpmailer($email, $subject, $html)) {
        return [false, 'Could not send the email. Please try again shortly.'];
    }

    $sends[] = $now;
    $_SESSION['otp_sends'] = $sends;
    $_SESSION['otp'] = [
        'hash'     => password_hash($code, PASSWORD_DEFAULT),
        'expires'  => $now + OTP_TTL,
        'attempts' => 0,
        'email'    => $email,
        'admin_id' => $adminId,
    ];

    return [true, 'A verification code was sent to ' . mask_email($email) . '.'];
}

/** @return array{0:bool,1:string} */
function admin_otp_verify(string $submitted): array
{
    $otp       = $_SESSION['otp'] ?? null;
    $pendingId = $_SESSION['admin_pending_id'] ?? null;

    if (!$otp || !$pendingId || (int) $otp['admin_id'] !== (int) $pendingId) {
        return [false, 'No active code. Please request a new one.'];
    }
    if (time() > $otp['expires']) {
        unset($_SESSION['otp']);
        return [false, 'This code has expired. Please request a new one.'];
    }

    // Count the attempt BEFORE checking, so it can't be skipped
    $_SESSION['otp']['attempts']++;

    $valid = preg_match('/^\d{6}$/', $submitted) === 1
          && password_verify($submitted, $otp['hash']);

    if (!$valid) {
        $left = OTP_MAX_ATTEMPTS - $_SESSION['otp']['attempts'];
        if ($left <= 0) {
            unset($_SESSION['otp']);
            return [false, 'Too many incorrect attempts. Please request a new code.'];
        }
        return [false, "Incorrect code. {$left} attempt" . ($left === 1 ? '' : 's') . ' remaining.'];
    }

    // SUCCESS: promote the session to a fully authenticated admin
    unset($_SESSION['otp'], $_SESSION['otp_sends'], $_SESSION['admin_pending_id']);
    session_regenerate_id(true); // prevents session fixation
    $now = time();
    $_SESSION['admin_']              = (int) $pendingId; // same key your old guard used
    $_SESSION['admin_otp_verified']  = $now;
    $_SESSION['admin_login_time']    = $now;
    $_SESSION['admin_last_activity'] = $now;

    return [true, ''];
}

// ---------------------------------------------------------------
//  Gate: call at the top of EVERY admin page / admin endpoint
// ---------------------------------------------------------------
function admin_require_auth(): void
{
    admin_session_start();
    admin_security_headers();
    $now = time();

    // Logout (keeps your existing ?logout=true behaviour)
    if (($_GET['logout'] ?? '') === 'true') {
        admin_logout();
        admin_redirect(admin_base_url() . 'login/');
    }

    $ok = !empty($_SESSION['admin_'])
       && !empty($_SESSION['admin_otp_verified'])
       && ($now - ($_SESSION['admin_login_time'] ?? 0))    < ADMIN_ABSOLUTE_TTL
       && ($now - ($_SESSION['admin_last_activity'] ?? 0)) < ADMIN_IDLE_TTL;

    // The admin row must still exist (same check your old guard did, but prepared)
    if ($ok) {
        global $connection;
        $aid = (int) $_SESSION['admin_'];
        $q = $connection->prepare("SELECT 1 FROM admin WHERE id = ? LIMIT 1");
        $q->bind_param('i', $aid);
        $q->execute();
        $q->store_result();
        $ok = $q->num_rows === 1;
        $q->close();
    }

    if (!$ok) {
        if (!empty($_SESSION['admin_pending_id'])) {
            admin_redirect(admin_base_url() . 'verify/'); // passed password, still needs OTP
        }
        admin_logout();
        admin_redirect(admin_base_url() . 'login/');
    }

    $_SESSION['admin_last_activity'] = $now;
}