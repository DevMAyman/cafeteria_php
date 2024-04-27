<?php
    require_once '../../helper/base.php';
    require_once '../../helper/db_connection _copy.php';
    require_once '../../config.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Dashboard</title>


    <link href="styles.css?<?php echo time(); ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>

    <div class="container mt-5">
        <h2>Rooms Dashboard</h2>
        <a href="add_room.php" class="btn btn-success mb-3">Add New Room</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                


                $conn = new Database(host, dbname, username, password, port);
                $conn->connectToDatabase();

                $rooms = Room::get_all_rooms($conn->getPdo());

                foreach ($rooms as $room) {
                    echo "<tr>";
                    echo "<td>{$room['room_name']}</td>";
                    echo "<td>{$room['room_number']}</td>";

                    echo "<td>
                    <a href='update_room.php?id={$room['id']}' ><i class='fas fa-edit'></i></a>
                    <a href='../../controller/room_controller.php?action=delete&id={$room['id']}' class='delete-icon' '><i class='fas fa-trash-alt' style='color: red;'></i></a>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>