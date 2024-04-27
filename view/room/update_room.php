<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Room</title>
    <?php include_once '../../helper/base.php'; ?>
    <link href="styles.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5 center-form">
        <h2>Update Room</h2>
        <?php
        include_once '../../model/room_model.php';
        require_once "../../helper/db_connection.php";
        require_once '../../config.php';


        $conn = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        $conn->connectToDatabase();
        
        // Check if ID is set and fetch room data
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $roomData = Room::get_room_by_id($conn->getPdo(), $id);
            // Check if room data exists
            if ($roomData) {
        ?>
        <form action="../../controller/room_controller.php?action=update" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $roomData['id']; ?>">
            <div class="form-group">
                <label for="room_name">Name:</label>
                <input type="text" class="form-control" id="room_name" name="room_name" value="<?php echo $roomData['room_name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="room_number">Room Number:</label>
                <input type="text" class="form-control" id="room_number" name="room_number" value="<?php echo $roomData['room_number']; ?>" required>
            </div>
            <div class="form-group">
                <label for="is_busy">Busy: true or false</label>
                <input type="text" class="form-control" id="is_busy" name="is_busy" value="<?php echo $roomData['is_busy']; ?>" required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="room_dashboard.php" class="btn btn-secondary">Back</a>
            </div>
        </form>
        <?php
            } else {
                echo "Room not found.";
            }
        } else {
            echo "Room ID not provided.";
        }
        ?>
    </div>

</body>

</html>
