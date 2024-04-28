<?php
require_once '../../helper/db_connection.php';
require_once '../../model/order_model.php';

if (isset($_POST['orderId'], $_POST['newStatus'])) {
    $orderId = $_POST['orderId'];
    $newStatus = $_POST['newStatus'];

    $conn = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
    $conn->connectToDatabase();

    if (Order::updateOrderStatus($conn->getPdo(), $orderId, $newStatus)) {
        // Redirect back to view_users_orders.php after successful update
        header("Location: view_users_orders.php");
        exit(); // Stop further execution
    } else {
        echo "Failed to update order status.";
    }
} else {
    echo "Order ID and new status are required.";
}
?>
