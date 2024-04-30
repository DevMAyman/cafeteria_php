<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Dashboard</title>
    <?php include_once '../../helper/base.php'; ?>
    <?php include_once '../../helper/db_connection.php'; ?>
    <?php include_once '../../config.php';?>
    <?php include_once '../../helper/pagination.php';?>


    <link href="styles.css?<?php echo time(); ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
    .pagination {
    list-style-type: none;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 20px;
}

.pagination li {
    margin: 0 5px;
}

.pagination li a {
    text-decoration: none;
    color: #333;
    padding: 8px 12px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.pagination li.active span {
    background-color: #007bff;
    color: #fff;
    padding: 8px 12px;
    border-radius: 5px;
}

.pagination li.active a {
    color: #fff;
}

    </style>
</head>

<body>

    <div class="container mt-5">
        <h2>Rooms Dashboard</h2>
        <a href="add_room.php" class="btn btn-success mb-3">Add New Room</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Room Number</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once '../../model/room_model.php';
                require_once '../../helper/db_connection.php';
                require_once '../../config.php';

                $conn = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
                $conn->connectToDatabase();

                $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                $recordsPerPage = 3; 
                $tableName = "rooms"; 

                $pagination = new Pagination($recordsPerPage, $currentPage, $tableName);


                $offset = ($currentPage - 1) * $recordsPerPage;

                $query = "SELECT * FROM $tableName LIMIT $offset, $recordsPerPage";
                $stmt = $conn->getPdo()->query($query);
                $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($rooms as $room) {
                    echo "<tr>";
                    echo "<td>{$room['room_name']}</td>";
                    echo "<td>{$room['room_number']}</td>";
                    echo "<td>
                            <a href='update_room.php?id={$room['id']}'><i class='fas fa-edit'></i></a>
                            <a href='../../controller/room_controller.php?action=delete&id={$room['id']}' class='delete-icon'><i class='fas fa-trash-alt' style='color: red;'></i></a>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <?php
        echo $pagination->render();
        ?>
    </div>

</body>

</html>
