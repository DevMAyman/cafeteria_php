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
        try {
            // Check if the room with the same name already exists
            $stmt_check = $conn->prepare("SELECT COUNT(*) as count FROM rooms WHERE room_name = :room_name");
            $stmt_check->bindParam(':room_name', $this->roomName);
            $stmt_check->execute();
            $result = $stmt_check->fetch(PDO::FETCH_ASSOC);
    
            if ($result['count'] == 0) {
                // Room with the same name doesn't exist, proceed with insertion
                $stmt = $conn->prepare("INSERT INTO rooms (room_number, room_name, is_busy) VALUES (:room_number, :room_name, :is_busy)");
                $stmt->bindParam(':room_number', $this->roomNumber);
                $stmt->bindParam(':room_name', $this->roomName);
                $stmt->bindParam(':is_busy', $this->isBusy);
                $stmt->execute();
                $this->id = $conn->lastInsertId();
                header("Location: ../view/room/room_dashboard.php");

            } else {
                echo '<img style ="width:300px;height:300px;margin-left: 460px;" src="https://cdn-icons-png.flaticon.com/512/5841/5841032.png"/>';
                echo "<h1 style='color: rgb(255,87,87);margin-top: 50px;margin-left: 370px;'> Room with the same name already exists. </h1>";

            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function update_room($conn) {
        try {
            // Check if the room with the same name already exists
            $stmt_check = $conn->prepare("SELECT COUNT(*) as count FROM rooms WHERE room_name = :room_name AND id != :id");
            $stmt_check->bindParam(':room_name', $this->roomName);
            $stmt_check->bindParam(':id', $this->id);
            $stmt_check->execute();
            $result = $stmt_check->fetch(PDO::FETCH_ASSOC);
    
            if ($result['count'] == 0) {
                // Room with the same name doesn't exist or exists with the same ID, proceed with update
                $stmt = $conn->prepare("UPDATE rooms SET room_number = :room_number, room_name = :room_name, is_busy = :is_busy WHERE id = :id");
                $stmt->bindParam(':room_number', $this->roomNumber);
                $stmt->bindParam(':room_name', $this->roomName);
                $stmt->bindParam(':is_busy', $this->isBusy);
                $stmt->bindParam(':id', $this->id);
                $stmt->execute();
                
                // Return a success message or indication
                return "Room updated successfully";
            } else {
                // Room with the same name already exists
                return "Room with the same name already exists.";
            }
        } catch (PDOException $e) {
            // Handle database errors
            return "Error: " . $e->getMessage();
        }
    }
    
    
    
    public static function delete_room($conn, $id) {
        $stmt = $conn->prepare("DELETE FROM rooms WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}

?>
