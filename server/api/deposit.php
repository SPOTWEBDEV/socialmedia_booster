
<?php
require '../connection.php'; // include your database connection



if (isset($_POST['action'])) {

    $action = $_POST['action'];

    $sql = '';

    if ($action == 'admin') {
        $sql = "SELECT deposits.* , users.fullname , users.email FROM deposits , users WHERE users.id= deposits.user ORDER BY deposits.id DESC";
    } else {
        $user = $_POST['userId'];
        $sql = "SELECT * FROM deposits WHERE user='$user' ORDER BY id DESC";
    }

    $result = $connection->query($sql);

    $deposit = [];

    while ($row = $result->fetch_assoc()) {
        $deposit[] = $row;
    }

    echo json_encode([
        "success" => true,
        "data" => $deposit
    ]);
}
