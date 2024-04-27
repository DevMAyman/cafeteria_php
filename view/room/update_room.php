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


        $conn = new Database(host, dbname, username, password, port);
        $conn->connectToDatabase();
        $rooms = Room::get_all_rooms($conn->getPdo());

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $roomData = Room::get_room_by_id($conn->getPdo(), $id);
        }

        ?>
        <form action="../../controller/room_controller.php?action=update" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $roomData['id']; ?>">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="room_name" name="room_name" value="<?php echo $roomData['room_name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="name">Room Number:</label>
                <input type="text" class="form-control" id="room_number" name="room_number" value="<?php echo $roomData['room_number']; ?>" required>
            </div>
            <div class="form-group">
                <label for="name">Busy: 1 or 0</label>
                <input type="text" class="form-control" id="is_busy" name="is_busy" value="<?php echo $roomData['is_busy']; ?>" required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="room_dashboard.php" class="btn btn-secondary">Back</a>
            </div>
        </form>
    </div>

</body>

</html>