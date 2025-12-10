<?php
require '../connection.php';

header("Content-Type: application/json");

// Check if ID was sent
if (!isset($_POST['id'])) {
    echo json_encode([
        "success" => false,
        "message" => "Missing account ID"
    ]);
    exit;
}

$id = intval($_POST['id']);

// Delete the record
$sql = "DELETE FROM payment_account WHERE id = $id";

if ($connection->query($sql)) {
    echo json_encode([
        "success" => true,
        "message" => "Payment account deleted successfully"
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Failed to delete account"]);
}

?>
