<?php
require_once '../model/category_model.php';
require_once '../helper/db_connection.php';

if ($_GET['action'] == 'add') {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $category_name = $_POST['category_name'];

        $db = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        $db->connectToDatabase();
        $conn = $db->getPdo();

        $category = new Category($category_name);
        $category->insert_category($conn);

        header("Location: ../view/product/add_product.php");
        exit;
    }
}
