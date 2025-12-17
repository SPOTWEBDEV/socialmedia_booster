<?php
require '../connection.php'; // include your database connection

$sql = "SELECT * FROM users ORDER BY id DESC";
$result = $connection->query($sql);

$users = [];

while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}

echo json_encode([
    "success" => true,
    "data" => $users
]);
