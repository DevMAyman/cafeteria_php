<?php
require_once '../helper/db_connection.php';
require_once '../model/order_item_model.php';
require_once '../model/order_model.php';
require_once '../base.php';
require_once './order_item_controller.php';

$conn = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
$conn->connectToDatabase();

$orderItemController = new OrderItemController();

try {
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the room ID and notes from the POST request
    $roomId = $_POST['room_id'];
    $notes = isset($_POST['notes']) ? $_POST['notes'] : '';

    $orderItemController = new OrderItemController();
    $orderItemController->placeOrder($roomId, $notes);
  }
} catch (Exception $e) {
  echo json_encode(['status' => 'error', 'message' => 'An error occurred: ' . $e->getMessage()]);
}
