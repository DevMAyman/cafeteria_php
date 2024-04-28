<?php

class OrderItem {
    private $id;
    private $quantity;
    private $price;
    private $order_id;
    private $product_id;
    
    public function __construct($id,$quantity, $price, $order_id , $product_id) {
        $this->id = $id;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->order_id = $order_id;
        $this->product_id = $product_id;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getQuantity() {
        return $this->quantity;
    }
    
    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }
    
    public function getPrice() {
        return $this->price;
    }
    
    public function setPrice($price) {
        $this->price = $price;
    }
    
    public function getOrderId() {
        return $this->order_id;
    }
    
    public function setOrderId($order_id) {
        $this->order_id = $order_id;
    }

    public function getProductId() {
        return $this->product_id;
    }
    
    public function setProductId($product_id) {
        $this->product_id = $product_id;
    }
    public static function getAllOrderItems($conn) {
        try {
            $stmt = $conn->query("SELECT * FROM order_items");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error fetching all order items: " . $e->getMessage());
            return null; // Or an empty array
        }
    }

    public static function getOrderItemById($conn, $id) {
        try {
            $stmt = $conn->prepare("SELECT * FROM order_items WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error fetching order item by ID: " . $e->getMessage());
            return null;
        }
    }

    public function addOrderItem($conn) {
        try {
            $stmt = $conn->prepare("INSERT INTO order_items (quantity, price, order_id, product_id) VALUES (:quantity, :price, :order_id, :product_id)");
            $stmt->bindParam(':quantity', $this->quantity);
            $stmt->bindParam(':price', $this->price);
            $stmt->bindParam(':order_id', $this->order_id);
            $stmt->bindParam(':product_id', $this->product_id);
            $stmt->execute();
            $this->id = $conn->lastInsertId();
        } catch (PDOException $e) {
            error_log("Error adding order item: " . $e->getMessage());
            return false;
        }
    }

    public function updateOrderItem($conn) {
        try {
            $stmt = $conn->prepare("UPDATE order_items SET quantity = :quantity, price = :price, order_id = :order_id, product_id = :product_id WHERE id = :id");
            $stmt->bindParam(':quantity', $this->quantity);
            $stmt->bindParam(':price', $this->price);
            $stmt->bindParam(':order_id', $this->order_id);
            $stmt->bindParam(':product_id', $this->product_id);
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error updating order item: " . $e->getMessage());
            return false;
        }
    }

    public static function deleteOrderItem($conn, $id) {
        try {
            $stmt = $conn->prepare("DELETE FROM order_items WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error deleting order item: " . $e->getmessage());
            return false;
        }
    }
    
}
