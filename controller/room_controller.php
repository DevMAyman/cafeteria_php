<?php

require_once "../helper/db_connection.php";
require_once "../model/room_model.php";


class RoomController
{

    private $conn;

    public function __construct()
    {
        $this->conn = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        $this->conn->connectToDatabase();
    }

    public function handleRequest()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_GET['action']) && $_GET['action'] == 'insert') {
                $roomNumber = $_POST['room_number'];
                $roomName = $_POST['room_name'];
                $isBusy = isset($_POST['is_busy']) ? true : false;

                $room = new Room($roomNumber, $roomName, $isBusy);
                $isInserted=$room->insert_room($this->conn);


 
                exit;
            } elseif (isset($_GET['action']) && $_GET['action'] == 'update') {
                try {
                    // Update logic
                    $roomNumber = $_POST['room_number'];
                    $roomName = $_POST['room_name'];
                    $isBusy = isset($_POST['is_busy']) ? true : false;
            
                    $room = new Room($roomNumber, $roomName, $isBusy);
                    // var_dump($room);
                    $updateResult = $room->update_room($this->conn); // Store the result of update_room
                    echo "Update result: " . $updateResult; // Print the result
                    // header("Location: ../view/room/room_dashboard.php");
                    exit;
                } catch (PDOException $e) {
                    // Handle database errors
                    echo "Error updating room: " . $e->getMessage();
                } catch (Exception $e) {
                    // Handle other exceptions
                    echo "Error updating room: " . $e->getMessage();
                }
            }
             else {
                echo "Invalid request";
            }
            
        } elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
            if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
                $id = $_GET['id'];
                Room::delete_room($this->conn, $id);
                header("Location: ../view/room/room_dashboard.php");
                exit;
            } else {
                echo "Invalid request";
            }
        } else {
            echo "Invalid request";
        }
    }
}

$roomController = new RoomController();
$roomController->handleRequest();
?>

