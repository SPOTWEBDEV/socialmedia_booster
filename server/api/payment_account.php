<?php
require '../connection.php'; // include your database connection

$sql = "SELECT * FROM payment_account ORDER BY id DESC";
$result = $connection->query($sql);

$payment_account = [];

while ($row = $result->fetch_assoc()) {
    $payment_account[] = $row;
}

echo json_encode([
    "success" => true,
    "data" => $payment_account
]);
