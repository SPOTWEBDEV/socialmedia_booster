<?php
/**
 * user_deposits.php
 * Returns a single user's deposit history as JSON.
 *
 * Expects POST: user_id
 * Returns JSON: { success: bool, data: [...] }
 */

include_once '../../server/connection.php';
include_once '../../server/auth/admin.php';

header('Content-Type: application/json');

$userId = $_POST['user_id'] ?? null;

if (!ctype_digit((string) $userId)) {
    echo json_encode(['success' => false, 'error' => 'Invalid user id.']);
    exit;
}

$userId = (int) $userId;

$stmt = mysqli_prepare($connection, "SELECT id, reference, method, amount, status, created_at FROM deposits WHERE user = ? ORDER BY created_at DESC");
mysqli_stmt_bind_param($stmt, "i", $userId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$rows = [];
while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
}

echo json_encode(['success' => true, 'data' => $rows]);

mysqli_stmt_close($stmt);
