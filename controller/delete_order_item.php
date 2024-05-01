<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (session_status() === PHP_SESSION_NONE) {
    session_start(); 
  }

  $productId = $_POST['product_id']; 

  if (isset($_SESSION['order_items'])) {
    $deleted = false; 

    foreach ($_SESSION['order_items'] as $key => $item) {
      if ($item['product_id'] === $productId) {
        unset($_SESSION['order_items'][$key]);
        $deleted = true; 
        break;
      }
    }

    if ($deleted) {
      echo json_encode(["status" => "success", "message" => "Order item deleted"]);
    } else {
      echo json_encode(["status" => "error", "message" => "Product ID not found"]);
    }
  } else {
    echo json_encode(["status" => "error", "message" => "Session order items not found"]);
  }
} else {
  echo json_encode(["status" => "error", "message" => "Invalid request"]);
}
