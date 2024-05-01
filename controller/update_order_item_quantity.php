// Filename: update_order_item_quantity.php
<?php
require_once '../helper/db_connection.php';
require_once '../model/order_item_model.php';

$conn = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
$conn->connectToDatabase();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $productId = $_POST['product_id'];
  $newQuantity = $_POST['quantity'];

  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }

  if (isset($_SESSION['order_items'])) {
    $updated = false; 
    foreach ($_SESSION['order_items'] as &$item) {
      if ($item['product_id'] === $productId) {
        $item['quantity'] = $newQuantity;
        $updated = true;
        break;
      }
    }

    if ($updated) {
      echo json_encode(["status" => "success", "message" => "Quantity updated"]);
    } else {
      echo json_encode(["status" => "error", "message" => "Product ID not found in session"]);
    }
  } else {
    echo json_encode(["status" => "error", "message" => "Session order items not found"]);
  }
} else {
  echo json_encode(["status" => "error", "message" => "Invalid request"]);
}
