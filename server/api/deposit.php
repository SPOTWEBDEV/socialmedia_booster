<?php
// header('Content-Type: application/json');
require '../connection.php';

if (isset($_POST['action'])) {

    $action = $_POST['action'];

    $deposit = [];

    if ($action == 'admin') {

        $sql = "SELECT deposits.* , users.fullname , users.email FROM deposits , users WHERE users.id= deposits.user ORDER BY deposits.id DESC";
        $result = $connection->query($sql);

        while ($row = $result->fetch_assoc()) {
            $deposit[] = $row;
        }

    } else {

        // Bound parameter instead of string interpolation — the previous
        // version built the query as "...WHERE user='$user'..." directly
        // from $_POST['userId'], which let anyone pass arbitrary SQL in
        // that field (e.g. to read other users' deposits/access codes).
        $user = $_POST['userId'];

        $stmt = $connection->prepare("SELECT * FROM deposits WHERE user = ? ORDER BY id DESC");
        $stmt->bind_param("i", $user);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $deposit[] = $row;
        }

        $stmt->close();
    }

    echo json_encode([
        "success" => true,
        "data" => $deposit
    ]);
}