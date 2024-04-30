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
  private $userId;

  public function __construct($total_amount, $notes, $status, $date, $total_quantity, $roomId, $userId)
  {
    $this->total_amount = $total_amount;
    $this->notes = $notes;
    $this->status = $status;
    $this->date = $date;
    $this->total_quantity = $total_quantity;
    $this->userId = $userId;
    $this->roomId = $roomId;
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

  public function getRoomId()
  {
    return $this->roomId;
  }

  public function getUserId()
  {
    return $this->userId;
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

  public function setRoomId($roomId)
  {
    $this->roomId = $roomId;
  }

  public function setUserId($userId)
  {
    $this->userId = $userId;
  }

  public static function getAllOrders($conn)
  {
    try {
      $stmt = $conn->query("SELECT * FROM orders");
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("Error fetching all orders: " . $e->getMessage());
      return null;
    }
  }

  public static function getOrderById($conn, $id)
  {
    try {
      $stmt = $conn->prepare("SELECT * FROM orders WHERE id = :id");
      $stmt->bindParam(':id', $id);
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("Error fetching order by ID: " . $e->getMessage());
      return null;
    }
  }

  public function addOrder($conn)
  {
    try {
      // Prepare the INSERT INTO statement, including room_id
      $stmt = $conn->prepare(
        "INSERT INTO orders (total_amount, notes, status, date, total_quantity, user_id, room_id) 
             VALUES (:total_amount, :notes, :status, :date, :total_quantity, :user_id, :room_id)"
      );

      // Bind the parameters to the prepared statement
      $stmt->bindParam(':total_amount', $this->total_amount);
      $stmt->bindParam(':notes', $this->notes);
      $stmt->bindParam(':status', $this->status);
      $stmt->bindParam(':date', $this->date);
      $stmt->bindParam(':total_quantity', $this->total_quantity);
      $stmt->bindParam(':user_id', $this->userId);  // Bind user_id
      $stmt->bindParam(':room_id', $this->roomId);  // Bind room_id

      // Execute the prepared statement
      $stmt->execute();

      // Store the ID of the newly inserted order
      $this->id = $conn->lastInsertId(); // Get the last inserted ID
      return $this->id; // Return the ID for further processing
    } catch (PDOException $e) {
      // Log the error message and return false on failure
      error_log("Error adding order: " . $e->getMessage());
      return false; // Indicate failure
    }
  }



  public function updateOrder($conn)
  {
    try {
      $stmt = $conn->prepare("UPDATE orders SET total_amount = :total_amount, notes = :notes, status = :status, date = :date, total_quantity = :total_quantity WHERE id = :id");
      $stmt->bindParam(':total_amount', $this->total_amount);
      $stmt->bindParam(':notes', $this->notes);
      $stmt->bindParam(':status', $this->status);
      $stmt->bindParam(':date', $this->date);
      $stmt->bindParam(':total_quantity', $this->total_quantity);
      $stmt->bindParam(':id', $this->id);
      $stmt->execute();
    } catch (PDOException $e) {
      error_log("Error updating order: " . $e->getMessage());
      return false;
    }
  }

  public static function deleteOrder($conn, $id)
  {
    try {
      $stmt = $conn->prepare("DELETE FROM orders WHERE id = :id");
      $stmt->bindParam(':id', $id);
      $stmt->execute();
    } catch (PDOException $e) {
      error_log("Error deleting order: " . $e->getMessage());
      return false;
    }
  }

  public static function updateOrderStatus($conn, $orderId, $newStatus)
  {
    try {
      $stmt = $conn->prepare("UPDATE orders SET status = :status WHERE id = :id");
      $stmt->bindParam(':status', $newStatus);
      $stmt->bindParam(':id', $orderId);
      $stmt->execute();
      return true;
    } catch (PDOException $e) {
      error_log("Error updating order status: " . $e->getMessage());
      return false;
    }
  }
}
