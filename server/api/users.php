<?php
require '../connection.php'; // include your database connection

$sql = "SELECT id, fullname, email, status, status_message, created_at FROM users ORDER BY id DESC";
$result = $connection->query($sql);

$users = [];

while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}

echo json_encode([
    "success" => true,
    "data" => $users
]);
