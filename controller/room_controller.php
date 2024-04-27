<?php

require_once "../helper/db_connection.php";
require_once "../model/room_model.php";


class RoomController
{

    private $conn;

    public function __construct()
    {
        $this->conn =new Database(host, dbname, username, password, port);
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
                var_dump($this->conn);
                $room->insert_room($this->conn);
                header("Location: ../view/room/room_dashboard.php");
                exit;
            } elseif (isset($_GET['action']) && $_GET['action'] == 'update') {
                try {
                    $id = $_POST['id'];
                    $roomNumber = $_POST['room_number'];
                    $roomName = $_POST['room_name'];
                    $isBusy = isset($_POST['is_busy']) ? true : false;
                    // Correcting the order of parameters when creating Room object
                    $room = new Room($roomNumber, $roomName, $isBusy); // Corrected order
                    var_dump($room);
                    $room->update_room($this->conn);
                } catch (Exception $e) {
                    echo "Error: " . $e->getMessage();
                    exit; // Optionally, you can exit here to prevent further execution
                }
                // header("Location: ../view/room/room_dashboard.php");
                exit;
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

