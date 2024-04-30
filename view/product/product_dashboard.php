<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Dashboard</title>
    <?php include_once '../../helper/base.php'; ?>
    <?php include_once '../../helper/db_connection.php'; ?>
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
        <h2>Product Dashboard</h2>
        <a href="add_product.php" class="btn btn-success mb-3">Add New Product</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once '../../model/product_model.php';
                require_once '../../helper/db_connection.php';


                $conn = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
                $conn->connectToDatabase();

                $products = Product::get_all_Products($conn->getPdo());

                $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                $recordsPerPage = 1; 
                $tableName = "products"; 

                $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                $recordsPerPage = 1; // Adjust as needed
                $tableName = "products";
                
                $pagination = new Pagination($recordsPerPage, $currentPage, $tableName);
                
                $offset = ($currentPage - 1) * $recordsPerPage;
                
                $query = "SELECT * FROM $tableName LIMIT $offset, $recordsPerPage";
                $stmt = $conn->getPdo()->query($query);
                $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                foreach ($products as $product) {
                    echo "<tr>";
                    echo "<td>{$product['name']}</td>";
                    echo "<td><img src='../../assets/{$product['image']}' alt='{$product['name']}' class='product-image'></td>";
                    echo "<td>{$product['price']}$</td>";
                    echo "<td>
                            <a href='update_product.php?id={$product['id']}' ><i class='fas fa-edit'></i></a>
                            <a href='../../controller/product_controller.php?action=delete&id={$product['id']}' class='delete-icon'><i class='fas fa-trash-alt' style='color: red;'></i></a>
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