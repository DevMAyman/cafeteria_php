<?php
require_once "../helper/db_connection _copy.php"; // Make sure to correct the filename if it contains a space
require '../config.php';
require_once "../model/order_item_model.php";

class OrderManager {
    private $conn;
    
    public function __construct($conn) {
        $this->conn = $conn; 
    }
    
    public function addProductToOrder($productId) {
        $product = $this->getProductById($productId);
        
        if ($product) {
            $orderItem = new OrderItem(1, $product['price'], $productId);
            $orderId = $this->insertOrderItem($orderItem);
            return $orderId;
        } else {
            return false;
        }
    }
    
    private function getProductById($productId) {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $product = $result->fetch_assoc();
            return $product;
        } else {
            return false;
        }
    }
    private function insertOrderItem($orderItem) {
        $stmt = $this->conn->prepare("INSERT INTO order_items (quantity, price, product_id) VALUES (?, ?, ?)");
        $stmt->bind_param("idi", $orderItem->getQuantity(), $orderItem->getPrice(), $orderItem->getProductId());
        $stmt->execute();
        return $stmt->insert_id;
    }
    
    // public function getOrderItems() {
    //     $orderItems = $this->selectOrderItems();
    //     return $orderItems;
    // }
    

    
    // private function selectOrderItems() {
    //     $result = $this->conn->query("SELECT * FROM order_items");
    //     $orderItems = array();
    //     while ($row = $result->fetch_assoc()) {
    //         $orderItem = new OrderItem($row['quantity'], $row['price'], $row['product_id']);
    //         $orderItem->setId($row['id']);
    //         $orderItems[] = $orderItem;
    //     }
    //     return $orderItems;
    // }
}

?>