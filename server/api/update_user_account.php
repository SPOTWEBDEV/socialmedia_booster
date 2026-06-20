<?php
/**
 * update_user_account.php
 * Handles two actions from the Users slide-over panel:
 *   - change_balance: POST { action: 'change_balance', user_id, balance }
 *   - suspend_user:   POST { action: 'suspend_user',   user_id, status_message }
 *
 * Returns JSON: { success: bool, error?: string }
 */

include_once '../../server/connection.php';
include_once '../../server/auth/admin.php';

header('Content-Type: application/json');

$action = $_POST['action'] ?? '';
$userId = $_POST['user_id'] ?? null;

if (!ctype_digit((string) $userId)) {
    echo json_encode(['success' => false, 'error' => 'Invalid user id.']);
    exit;
}
$userId = (int) $userId;

if ($action === 'change_balance') {
    $balance = filter_var($_POST['balance'] ?? null, FILTER_VALIDATE_FLOAT);

    if ($balance === false) {
        echo json_encode(['success' => false, 'error' => 'Invalid balance amount.']);
        exit;
    }

    $stmt = mysqli_prepare($connection, "UPDATE users SET balance = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "di", $balance, $userId);

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['success' => true, 'balance' => $balance]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Could not update balance.']);
    }
    mysqli_stmt_close($stmt);
    exit;
}

if ($action === 'suspend_user') {
    $statusMessage = trim($_POST['status_message'] ?? '');

    if ($statusMessage === '') {
        echo json_encode(['success' => false, 'error' => 'A suspension reason is required.']);
        exit;
    }

    $status = 'suspended';
    $stmt = mysqli_prepare($connection, "UPDATE users SET status = ?, status_message = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "ssi", $status, $statusMessage, $userId);

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['success' => true, 'status' => $status, 'status_message' => $statusMessage]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Could not suspend user.']);
    }
    mysqli_stmt_close($stmt);
    exit;
}

echo json_encode(['success' => false, 'error' => 'Unknown action.']);
