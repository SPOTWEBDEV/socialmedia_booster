<?php
// 1. Enforce strict error reporting for development tracking
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set header to JSON immediately so any crash outputs text we can read
header('Content-Type: application/json');

// 2. Load connection dependencies using once-only safety assertions
require_once '../connection.php';
require_once '../controller/boosting.php'; 

// 3. Hydrate the API Object class instance with the core dynamic token
$api = new Api($api_key);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die(json_encode(["success" => false, "message" => "Direct browser access denied. Send a POST request."]));
}

if (isset($_POST['action'])) {
    $action = $_POST['action'];

    switch ($action) {

        case 'fetchAllOrders':
            $orders = fetchAllOrders();
            $ordersArray = [];

            if ($orders) {
                while ($row = $orders->fetch_assoc()) {
                    // Check if we have a valid order_id to query
                    if (!empty($row['order_id'])) {
                        // Pull live API status lookup object
                        $apiStatusRaw = $api->status($row['order_id']);
                        $apiStatus = (array)$apiStatusRaw;
                    } else {
                        $apiStatus = [];
                    }

                    // Map fields with strict fallbacks
                    $row['status']          = $apiStatus['status'] ?? "Unknown";
                    $row['charge_api']      = $apiStatus['charge'] ?? "N/A";
                    $row['start_count_api'] = $apiStatus['start_count'] ?? "N/A";
                    $row['remains_api']     = $apiStatus['remains'] ?? "N/A";
                    $row['currency_api']    = $apiStatus['currency'] ?? ($row['currency'] ?? 'USD');

                    $ordersArray[] = $row;
                }
            }

            echo json_encode(["success" => true, "data" => $ordersArray]);
            break;


        case 'fetchUserOrders':
            if (!isset($_POST['userId'])) {
                echo json_encode(["success" => false, "message" => "Missing User ID"]);
                exit;
            }
            
            $userId = $_POST['userId'];
            $orders = fetchUserOrders($connection, $userId);
            $ordersArray = [];

            if ($orders) {
                while ($row = $orders->fetch_assoc()) {
                    if (!empty($row['order_id'])) {
                        $apiStatusRaw = $api->status($row['order_id']);
                        $apiStatus = (array)$apiStatusRaw;
                    } else {
                        $apiStatus = [];
                    }

                    $row['status']          = $apiStatus['status'] ?? "Unknown";
                    $row['charge_api']      = $apiStatus['charge'] ?? "N/A";
                    $row['start_count_api'] = $apiStatus['start_count'] ?? "N/A";
                    $row['remains_api']     = $apiStatus['remains'] ?? "N/A";
                    $row['currency_api']    = $apiStatus['currency'] ?? ($row['currency'] ?? 'USD');

                    $ordersArray[] = $row;
                }
            }

            echo json_encode(["success" => true, "data" => $ordersArray]);
            break;


        case 'fetchSingleOrder':
            if (!isset($_POST['id'])) {
                echo json_encode(["success" => false, "message" => "Missing Order ID"]);
                exit;
            }
            $id = $_POST['id'];
            $order = fetchSingleOrder($connection, $id);
            echo json_encode(["success" => true, "data" => $order]);
            break;

        case 'updateOrder':
            if (!isset($_POST['id'], $_POST['status'], $_POST['remains'])) {
                echo json_encode(["success" => false, "message" => "Missing Update Parameters"]);
                exit;
            }
            $id = $_POST['id'];
            $status = $_POST['status'];
            $remains = $_POST['remains'];
            $updated = updateOrder($connection, $id, $status, $remains);
            echo json_encode(["success" => $updated]);
            break;

        case 'deleteOrder':
            if (!isset($_POST['id'])) {
                echo json_encode(["success" => false, "message" => "Missing Order ID"]);
                exit;
            }
            $id = $_POST['id'];
            $deleted = deleteOrder($connection, $id);
            echo json_encode(["success" => $deleted]);
            break;

        default:
            echo json_encode(["success" => false, "message" => "Invalid action: " . $action]);
    }

} else {
    echo json_encode(["success" => false, "message" => "No action specified in request keys."]);
}


/* ✅ Fetch all orders (Admin) - Added LIMIT 20 to prevent script timeouts */
function fetchAllOrders()
{
    global $connection;
    $sql = "SELECT user_orders.*, users.fullname FROM user_orders, users WHERE users.id = user_orders.user ORDER BY user_orders.id DESC LIMIT 20";
    return $connection->query($sql);
}


/* ✅ Fetch orders for one user - Added LIMIT 20 */
function fetchUserOrders($connection, $userId)
{
    $stmt = $connection->prepare("
        SELECT user_orders.*, users.fullname FROM user_orders, users WHERE user_orders.user = ? AND users.id = ? ORDER BY user_orders.id DESC LIMIT 20
    ");

    $stmt->bind_param("ss", $userId, $userId);
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
?>