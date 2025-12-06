<?php

require '../controller/boosting.php'; // Include your API class
 require '../connection.php';


if (isset($_POST['action'])) {

    $action = $_POST['action'];
    $api = new Api();

    switch ($action) {

        /* =============================
            FETCH ALL ORDERS (ADMIN)
        ==============================*/
        case 'fetchAllOrders':
            $orders = fetchAllOrders($connection);
            $ordersArray = [];

            while ($row = $orders->fetch_assoc()) {

                // Fetch LIVE API STATUS
                $apiStatus = $api->status($row['order_id']);
                $apiStatus = json_decode(json_encode($apiStatus), true);

                // Attach LIVE status to array
                $row['status']      = $apiStatus['status'] ?? "Unknown";
                $row['charge_api']      = $apiStatus['charge'] ?? "N/A";
                $row['start_count_api'] = $apiStatus['start_count'] ?? "N/A";
                $row['remains_api']     = $apiStatus['remains'] ?? "N/A";
                $row['currency_api']    = $apiStatus['currency'] ?? $row['currency'];

                $ordersArray[] = $row;
            }

            echo json_encode(["success" => true, "data" => $ordersArray]);
            break;


        /* =============================
            FETCH USER ORDERS (ONE USER)
        ==============================*/
        case 'fetchUserOrders':
            $userId = $_POST['userId'];
            $orders = fetchUserOrders($connection, $userId);

            $ordersArray = [];

            while ($row = $orders->fetch_assoc()) {

                // Fetch LIVE API STATUS
                $apiStatus = $api->status($row['order_id']);
                $apiStatus = json_decode(json_encode($apiStatus), true);

                // Attach LIVE status to row
                $row['status']      = $apiStatus['status'] ?? "Unknown";
                $row['charge_api']      = $apiStatus['charge'] ?? "N/A";
                $row['start_count_api'] = $apiStatus['start_count'] ?? "N/A";
                $row['remains_api']     = $apiStatus['remains'] ?? "N/A";
                $row['currency_api']    = $apiStatus['currency'] ?? $row['currency'];

                $ordersArray[] = $row;
            }

            echo json_encode(["success" => true, "data" => $ordersArray]);
            break;


        /* =============================
            OTHER ACTIONS
        ==============================*/
        case 'fetchSingleOrder':
            $id = $_POST['id'];
            $order = fetchSingleOrder($connection, $id);
            echo json_encode(["success" => true, "data" => $order]);
            break;

        case 'updateOrder':
            $id = $_POST['id'];
            $status = $_POST['status'];
            $remains = $_POST['remains'];
            $updated = updateOrder($connection, $id, $status, $remains);
            echo json_encode(["success" => $updated]);
            break;

        case 'deleteOrder':
            $id = $_POST['id'];
            $deleted = deleteOrder($connection, $id);
            echo json_encode(["success" => $deleted]);
            break;

        default:
            echo json_encode(["success" => false, "message" => "Invalid action"]);
    }

} else {
    echo json_encode(["success" => false, "message" => "No action specified"]);
}

/* SQL FUNCTIONS BELOW — unchanged */



/* ✅ Fetch all orders (Admin) */
function fetchAllOrders($connection)
{
    $sql = "SELECT user_orders.*, users.fullname FROM user_orders , users WHERE users.id = user_orders.user  ORDER BY id DESC";
    return $connection->query($sql);
}


/* ✅ Fetch orders for one user */
function fetchUserOrders($connection, $userId)
{
    $stmt = $connection->prepare("
        SELECT user_orders.*, users.fullname FROM user_orders , users WHERE user_orders.user = ? AND users.id = ? ORDER BY id DESC
    ");

    $stmt->bind_param("ss", $userId,$userId);
    $stmt->execute();
    return $stmt->get_result();
}


/* ✅ Fetch single order */
function fetchSingleOrder($connection, $id)
{
    $stmt = $connection->prepare("SELECT * FROM user_orders WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}


/* ✅ Update order */
function updateOrder($connection, $id, $status, $remains)
{
    $stmt = $connection->prepare("
        UPDATE user_orders SET status = ?, remains = ? WHERE id = ?
    ");

    $stmt->bind_param("sii", $status, $remains, $id);
    return $stmt->execute();
}


/* ✅ Delete order (Admin only) */
function deleteOrder($connection, $id)
{
    $stmt = $connection->prepare("DELETE FROM user_orders WHERE id = ?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}
