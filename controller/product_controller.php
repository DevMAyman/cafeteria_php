<?php

include_once '../model/Product_model.php';
require_once '../helper/connect_to_db.php';

// Create products table if not exists
function create_table_if_not_exists($conn)
{
    $sql = "
    CREATE TABLE IF NOT EXISTS products (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        price DECIMAL(10, 2) NOT NULL,
        image VARCHAR(255) NOT NULL,
        isAvailable BOOLEAN NOT NULL,
        category_id INT(11) NOT NULL,
        FOREIGN KEY (category_id) REFERENCES categories(id)
    )";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    } catch (Exception $e) {
        echo "<h3 style='color:red'>{$e->getMessage()}</h3>";
        return false;
    }
}

// Create
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    $image = $_FILES['image']['name'];
    $isAvailable = true; // or false based on your logic

    $target_dir = "../assets/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);

    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    $product = new Product(null, $name, $price, $image, $isAvailable, $category_id);
    $conn = connect_to_db();
    create_table_if_not_exists($conn);  // Ensure the table exists
    $product->save($conn);

    header("Location: add_product.php");
    exit();
}

// Read
function getAllProducts()
{
    $conn = connect_to_db();
    return Product::getAllProducts($conn);
}

// Update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_product'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    $image = $_FILES['image']['name'];
    $isAvailable = true; // or false based on your logic

    $target_dir = "../assets/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);

    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    $product = new Product($id, $name, $price, $image, $isAvailable, $category_id);
    $conn = connect_to_db();
    $product->update($conn);

    header("Location: update_product.php?id=$id");
    exit();
}

// Delete
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = $_GET['id'];
    $conn = connect_to_db();
    Product::delete($conn, $id);

    header("Location: product_dashboard.php");
    exit();
}
