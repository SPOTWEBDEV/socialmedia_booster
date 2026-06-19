<?php
/**
 * send_reachout.php
 * Handles the bulk "User Reachout" form submission.
 *
 * Expects POST:
 *   subject        string
 *   message        string  (plain text the admin typed)
 *   recipients     string  (JSON array of {id, email, fullname})
 *
 * Returns JSON: { success: bool, sent: int, failed: array }
 */

header('Content-Type: application/json');

include_once '../../server/connection.php';
include_once '../../server/model.php';
include_once '../../server/auth/admin.php';
include_once './email_template.php';
include_once '../../mailer/index.php'; 
$response = ['success' => false, 'sent' => 0, 'failed' => []];

$subject    = trim($_POST['subject'] ?? '');
$message    = trim($_POST['message'] ?? '');
$recipients = json_decode($_POST['recipients'] ?? '[]', true);

if ($subject === '' || $message === '') {
    $response['error'] = 'Subject and message are both required.';
    echo json_encode($response);
    exit;
}

if (!is_array($recipients) || count($recipients) === 0) {
    $response['error'] = 'Select at least one recipient.';
    echo json_encode($response);
    exit;
}

foreach ($recipients as $recipient) {
    $email = filter_var($recipient['email'] ?? '', FILTER_VALIDATE_EMAIL);
    $name  = $recipient['fullname'] ?? '';

    if (!$email) {
        $response['failed'][] = ['email' => $recipient['email'] ?? '(missing)', 'reason' => 'Invalid email address'];
        continue;
    }

    $html = buildEmailHtml($subject, $message, $name);
    $ok   = smtpmailer($email, $subject, $html);

    if ($ok) {
        $response['sent']++;
    } else {
        $response['failed'][] = ['email' => $email, 'reason' => 'Send failed'];
    }
}

$response['success'] = $response['sent'] > 0;
echo json_encode($response);
