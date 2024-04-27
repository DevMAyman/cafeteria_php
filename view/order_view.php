<?php
include '../base.php';

// try {
//     include '../controller/OrderController.php';
//     include '../helper/db_connection.php';

//     $orderDAO = new OrderController();

//     $order = new Order(100.50, "Fast delivery", "Pending", "2023-11-01", 5);
//     $isInserted = $orderDAO->addOrder($order);

//     if ($isInserted) {
//         echo "Order successfully inserted!";
//     } else {
//         echo "Failed to insert order.";
//     }
// } catch (Exception $e) {
//     echo "An error occurred: " . $e->getMessage();
// }


try {
    include '../controller/OrderController.php';
    include '../helper/db_connection.php';

    $orderController = new OrderController();

    $orders = $orderController->getAllOrders();
    // var_dump($orders);
    foreach ($orders as $order) {
        echo "Order ID: " . $order["id"] . "<br>";
        echo "Amount: " . $order["total_amount"] . "<br>";
        echo "Description: " . $order["notes"] . "<br>";
        echo "Status: " . $order["status"] . "<br>";
        echo "Date: " . $order["date"] . "<br>";
        echo "Total Quantity: " . $order["total_quantity"] . "<br>";
        echo "<br>";
    }
} catch (Exception $e) {
    echo "An error occurred: " . $e->getMessage();
}
