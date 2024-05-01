<?php
require ('../model/user_model.php');
     include_once '../helper/base.php';
     include_once '../helper/db_connection.php';
     include_once '../config.php';
     include_once '../helper/pagination.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_user'])) {
    $user_id = $_POST['user_id'];
    UserModel::delete_user($user_id);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();

}


$users = UserModel::get_all_users();
 $conn = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
                $conn->connectToDatabase();

                $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                $recordsPerPage = 2; 
                $tableName = "users"; 

                $pagination = new Pagination($recordsPerPage, $currentPage, $tableName);


                $offset = ($currentPage - 1) * $recordsPerPage;

                $query = "SELECT * FROM $tableName LIMIT $offset, $recordsPerPage";
                $stmt = $conn->getPdo()->query($query);
                $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
        <h2 class="text-center mb-4">User Management</h2>
        <a href="user_view.php" class="btn btn-success mb-3">Add New User</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Room Number</th>
                    <th>Ext.</th>
                    <th>Profile Picture</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo $user['name']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo $user['room_no']; ?></td>
                        <td><?php echo $user['ext']; ?></td>
                        <td><img style="width:100px;" src="<?php echo $user['profile_picture']; ?>" alt=""></td>
                        <td><?php echo $user['role']; ?></td>

                        <td>
                            <form action="../view/update_user_form.php" method="post" style="display: inline;">
                                <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">

                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" style="display: inline;">
                                <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                <button type="submit" name="delete_user" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
         <?php
        echo $pagination->render();
        ?>
    </div>
</body>

</html>
