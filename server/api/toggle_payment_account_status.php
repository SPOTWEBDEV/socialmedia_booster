<?php
/**
 * toggle_payment_account_status.php
 * Flips a payment account between active / inactive.
 *
 * Expects POST: id, status ('active' | 'inactive')
 * Returns JSON: { success: bool, error?: string }
 */

include_once '../connection.php';
include_once '../auth/admin.php';

header('Content-Type: application/json');

$id     = $_POST['id'] ?? null;
$status = $_POST['status'] ?? null;

if (!ctype_digit((string) $id) || !in_array($status, ['active', 'inactive'], true)) {
    echo json_encode(['success' => false, 'error' => 'Invalid request.']);
    exit;
}

$id = (int) $id;

$query = "UPDATE payment_account SET status = ? WHERE id = ?";
$stmt = mysqli_prepare($connection, $query);

if (!$stmt) {
    echo json_encode(['success' => false, 'error' => 'Server error.']);
    exit;
}

mysqli_stmt_bind_param($stmt, "si", $status, $id);

if (mysqli_stmt_execute($stmt)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Could not update status.']);
}

mysqli_stmt_close($stmt);
