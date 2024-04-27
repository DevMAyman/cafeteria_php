<?php

class Room {
    private $id;
    private $roomNumber;
    private $roomName;
    private $isBusy;
    
    public function __construct($roomNumber, $roomName, $isBusy) {
        $this->roomNumber = $roomNumber;
        $this->roomName = $roomName;
        $this->isBusy = $isBusy;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getRoomNumber() {
        return $this->roomNumber;
    }
    
    public function setRoomNumber($roomNumber) {
        $this->roomNumber = $roomNumber;
    }
    
    public function getRoomName() {
        return $this->roomName;
    }
    
    public function setRoomName($roomName) {
        $this->roomName = $roomName;
    }
    
    public function getIsBusy() {
        return $this->isBusy;
    }
    
    public function setIsBusy($isBusy) {
        $this->isBusy = $isBusy;
    }
    
    // CRUD operations
    
    public static function get_all_rooms($conn) {
        $stmt = $conn->query("SELECT * FROM rooms");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public static function get_room_by_id($conn, $id) {
        $stmt = $conn->prepare("SELECT * FROM rooms WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function insert_room($conn) {
        // var_dump ($conn);
            try {
                $stmt = $conn->prepare("INSERT INTO rooms (room_number, room_name, is_busy) VALUES (:room_number, :room_name, :is_busy)");
                $stmt->bindParam(':room_number', $this->roomNumber);
                $stmt->bindParam(':room_name', $this->roomName);
                $stmt->bindParam(':is_busy', $this->isBusy);
                $stmt->execute();
                $this->id = $conn->lastInsertId();
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
    }
    
    public function update_room($conn) {
        try {
            $stmt = $conn->prepare("UPDATE rooms SET room_number = :room_number, room_name = :room_name, is_busy = :is_busy WHERE id = :id");
            $stmt->bindParam(':room_number', $this->roomNumber);
            $stmt->bindParam(':room_name', $this->roomName);
            $stmt->bindParam(':is_busy', $this->isBusy);
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Error updating room: " . $e->getMessage());
        }
    }
    
    
    public static function delete_room($conn, $id) {
        $stmt = $conn->prepare("DELETE FROM rooms WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}

?>
