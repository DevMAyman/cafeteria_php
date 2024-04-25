<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Dashboard</title>
    <?php include_once '../../helper/base.php'; ?>
    <?php include_once '../../helper/connect_to_db.php'; ?>
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
                require_once '../../helper/connect_to_db.php';

                $conn = connect_to_db();
                $products = Product::getAllProducts($conn);

                foreach ($products as $product) {
                    echo "<tr>";
                    echo "<td>{$product['name']}</td>";
                    echo "<td><img src='../assets/{$product['image']}' alt='{$product['name']}' class='product-image'></td>";
                    echo "<td>{$product['price']}</td>";
                    echo "<td>
                            <a href='update_product.php?id={$product['id']}' class='btn btn-primary'>Update</a>
                            <a href='product_controller.php?action=delete&id={$product['id']}' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this product?\");'>Delete</a>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>