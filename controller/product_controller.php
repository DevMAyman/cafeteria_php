<?php

include_once '../helper/db_connection.php';
include_once '../model/product_model.php';

class ProductController
{

    private $conn;

    public function __construct()
    {
        $this->conn = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        $this->conn->connectToDatabase();
    }

    public function uploadImage($file)
    {
        $targetDir = "../assets/";
        $targetFile = $targetDir . basename($file["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($file["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            return "File is not an image.";
        }

        // Check file size (currently set to 5MB)
        if ($file["size"] > 5000000) {
            return "Sorry, your file is too large.";
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            return "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            return "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($file["tmp_name"], $targetFile)) {
                return $targetFile;
            } else {
                return "Sorry, there was an error uploading your file.";
            }
        }
    }

    public function handleRequest()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_GET['action']) && $_GET['action'] == 'insert') {
                try {

                    $name = $_POST['name'];
                    $price = $_POST['price'];
                    $categoryId = $_POST['category_id'];
                    $image = $this->uploadImage($_FILES["image"]);

                    var_dump($name);
                    var_dump($price);
                    var_dump($categoryId);
                    var_dump($image);


                    $product = new Product( null ,$name, $price, $image, true, $categoryId);
                    $product->insert_product($this->conn);
                    header("Location: ../view/product/product_dashboard.php");
                    exit;
                } catch (Exception $e) {
                    echo $e->getMessage(); 
                }
            } elseif (isset($_GET['action']) && $_GET['action'] == 'update') {
                $id = $_POST['id'];
                $name = $_POST['name'];
                $price = $_POST['price'];
                $categoryId = $_POST['category_id'];
                $old_image = $_POST['old_image'];

                $image = $_FILES['image']['size'] > 0 ? $this->uploadImage($_FILES["image"]) : $old_image;

                $isAvailable = isset($_POST['isAvailable']) ? true : false;
                $product = new Product($id, $name, $price, $image, $isAvailable, $categoryId);
                $product->update_product($this->conn);
                header("Location: ../view/product/product_dashboard.php");
                exit;
            } else {
                echo "Invalid request";
            }
        } elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
            if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
                $id = $_GET['id'];
                Product::delete_product($this->conn, $id);
                header("Location: ../view/product/product_dashboard.php");
                exit;
            } else {
                echo "Invalid request";
            }
        } else {
            echo "Invalid request";
        }
    }
}

$productController = new ProductController();
$productController->handleRequest();
