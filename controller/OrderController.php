<?php

include '../helper/db_connection.php';
include '../model/order_model.php';
class OrderController
{
  private $db;

  public function __construct()
  {
    $database = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
    $database->connectToDatabase();
    $this->db = $database->getPdo();
  }

  public function getAllOrders()
  {
    $query = "select * from orders";
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getOrderById($orderId)
  {
    $query = "select * from ordere where id = ?";
    $stmt = $this->db->prepare($query);
    $stmt->bindValue(1, $orderId);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function addOrder(Order $order)
  {
    $query = "insert into orders (total_amount, notes, status, date, total_quantity) VALUES (?, ?, ?, ?, ?)";
    $stmt = $this->db->prepare($query);

    $stmt->bindValue(1, $order->getTotalAmount());
    $stmt->bindValue(2, $order->getNotes());
    $stmt->bindValue(3, $order->getStatus());
    $stmt->bindValue(4, $order->getDate());
    $stmt->bindValue(5, $order->getTotalQuantity());
    return $stmt->execute();
  }

  public function updateOrder(Order $order)
  {
    $query = "update orders set total_amount = ?, notes = ?, status = ?, date = ?, total_quantity = ? where id = ?";
    $stmt = $this->db->prepare($query);
    $stmt->bindValue(1, $order->getTotalAmount());
    $stmt->bindValue(2, $order->getNotes());
    $stmt->bindValue(3, $order->getStatus());
    $stmt->bindValue(4, $order->getDate());
    $stmt->bindValue(5, $order->getTotalQuantity());
    $stmt->bindValue(6, $order->getId());
    return $stmt->execute();
  }

  public function deleteOrder($orderId)
  {
    $query = "delete from orders where id = ?";
    $stmt = $this->db->prepare($query);
    $stmt->bindValue(1, $orderId);
    return $stmt->execute();
  }
}
