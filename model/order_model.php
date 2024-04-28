<?php

class Order
{
  private $id;
  private $total_amount;
  private $notes;
  private $status;
  private $date;

  private $roomId;

  private $total_quantity;

  public function __construct($total_amount, $notes, $status, $date, $total_quantity)
  {
    $this->total_amount = $total_amount;
    $this->notes = $notes;
    $this->status = $status;
    $this->date = $date;
    $this->total_quantity = $total_quantity;
  }
  public function getId()
  {
    return $this->id;
  }

  public function getTotalAmount()
  {
    return $this->total_amount;
  }

  public function getNotes()
  {
    return $this->notes;
  }

  public function getStatus()
  {
    return $this->status;
  }

  public function getDate()
  {
    return $this->date;
  }

  public function getTotalQuantity()
  {
    return $this->total_quantity;
  }
  public function setTotalAmount($total_amount)
  {
    $this->total_amount = $total_amount;
  }

  public function setNotes($notes)
  {
    $this->notes = $notes;
  }

  public function setStatus($status)
  {
    $this->status = $status;
  }

  public function setDate($date)
  {
    $this->date = $date;
  }

  public function setTotalQuantity($total_quantity)
  {
    $this->total_quantity = $total_quantity;
  }

  public static function getAllOrders($conn)
  {
      $stmt = $conn->query("SELECT * FROM orders");
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function getOrderById($conn, $id)
  {
      $stmt = $conn->prepare("SELECT * FROM orders WHERE id = :id");
      $stmt->bindParam(':id', $id);
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function addOrder($conn)
  {
      $stmt = $conn->prepare("INSERT INTO orders (total_amount, notes, status, date, total_quantity) VALUES (:total_amount, :notes, :status, :date, :total_quantity)");
      $stmt->bindParam(':total_amount', $this->total_amount);
      $stmt->bindParam(':notes', $this->notes);
      $stmt->bindParam(':status', $this->status);
      $stmt->bindParam(':date', $this->date);
      $stmt->bindParam(':total_quantity', $this->total_quantity);
      $stmt->execute();
      $this->id = $conn->lastInsertId();
  }

  public function updateOrder($conn)
  {
      $stmt = $conn->prepare("UPDATE orders SET total_amount = :total_amount, notes = :notes, status = :status, date = :date, total_quantity = :total_quantity WHERE id = :id");
      $stmt->bindParam(':total_amount', $this->total_amount);
      $stmt->bindParam(':notes', $this->notes);
      $stmt->bindParam(':status', $this->status);
      $stmt->bindParam(':date', $this->date);
      $stmt->bindParam(':total_quantity', $this->total_quantity);
      $stmt->bindParam(':id', $this->id);
      $stmt->execute();
  }

  public static function deleteOrder($conn, $id)
  {
      $stmt = $conn->prepare("DELETE FROM orders WHERE id = :id");
      $stmt->bindParam(':id', $id);
      $stmt->execute();
  }
}