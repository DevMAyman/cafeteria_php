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
        require_once "../helper/db_connection_copy.php";
        require '../config.php';


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
                <label for="isBusy">Available:</label>
                <input type="checkbox" id="isBusy" name="isBusy" <?php if ($roomData['isBusy']) echo 'checked'; ?>>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="room_dashboard.php" class="btn btn-secondary">Back</a>
            </div>
        </form>
    </div>

</body>

</html>