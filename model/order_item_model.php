<?php

class OrderItem {
    private $id;
    private $quantity;
    private $price;
    // private $order_id;
    private $product_id;
    
    public function __construct($quantity, $price, $order_id , $product_id) {
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
    
    public function setProductId($order_id) {
        $this->product_id = $product_id;
    }
    
}

?>