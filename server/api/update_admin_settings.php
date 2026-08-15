<?php
/**
 * server/api/update_admin_settings.php
 * Handles two admin settings actions:
 *   action = change_password  POST { current_password, new_password }
 *   action = save_auth_email  POST { auth_email }
 *
 * Returns JSON: { success: bool, error?: string }
 */

include_once '../../server/connection.php';
include_once '../../server/auth/admin.php';

header('Content-Type: application/json');

$action = $_POST['action'] ?? '';

// ===================================================
//  CHANGE PASSWORD
// ===================================================
if ($action === 'change_password') {
    $currentPw = $_POST['current_password'] ?? '';
    $newPw     = $_POST['new_password'] ?? '';

    if (strlen($newPw) < 8) {
        echo json_encode(['success' => false, 'error' => 'New password must be at least 8 characters.']);
        exit;
    }

    // Fetch current stored password
    $stmt = mysqli_prepare($connection, "SELECT `password` FROM admin WHERE id = 1");
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $adminRow = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    if (!$adminRow) {
        echo json_encode(['success' => false, 'error' => 'Admin record not found.']);
        exit;
    }

    $storedHash = $adminRow['password'];

    // Support both legacy plaintext (during migration) and hashed passwords.
    // Once the admin has changed their password via this page, all future
    // logins will use password_verify(). The login page (see update below)
    // should use password_verify() exclusively going forward.
    $valid = password_verify($currentPw, $storedHash) || ($currentPw === $storedHash);

    if (!$valid) {
        echo json_encode(['success' => false, 'error' => 'Current password is incorrect.']);
        exit;
    }

    $newHash = password_hash($newPw, PASSWORD_DEFAULT);
    $upd = mysqli_prepare($connection, "UPDATE admin SET `password` = ? WHERE id = 1");
    mysqli_stmt_bind_param($upd, "s", $newHash);

    if (mysqli_stmt_execute($upd)) {
        mysqli_stmt_close($upd);
        echo json_encode(['success' => true]);
    } else {
        mysqli_stmt_close($upd);
        echo json_encode(['success' => false, 'error' => 'Database error — password not updated.']);
    }
    exit;
}

// ===================================================
//  SAVE AUTH EMAIL
// ===================================================
if ($action === 'save_auth_email') {
    $authEmail = trim($_POST['auth_email'] ?? '');

    if (!filter_var($authEmail, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'error' => 'Enter a valid email address.']);
        exit;
    }

    // Add auth_email column if it doesn't exist yet (safe to run repeatedly).
    mysqli_query($connection, "ALTER TABLE admin ADD COLUMN IF NOT EXISTS `auth_email` VARCHAR(255) DEFAULT NULL");

    $upd = mysqli_prepare($connection, "UPDATE admin SET auth_email = ? WHERE id = 1");
    mysqli_stmt_bind_param($upd, "s", $authEmail);

    if (mysqli_stmt_execute($upd)) {
        mysqli_stmt_close($upd);
        echo json_encode(['success' => true]);
    } else {
        mysqli_stmt_close($upd);
        echo json_encode(['success' => false, 'error' => 'Database error — email not saved.']);
    }
    exit;
}

echo json_encode(['success' => false, 'error' => 'Unknown action.']);
