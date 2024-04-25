<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $price = $_POST['price'];
    $categoryId = $_POST['category_id'];
    $imageName = $_FILES["image"]["name"];
    $targetDir = $_SERVER['DOCUMENT_ROOT'] . "/cafeteria_php/assets/";
    $targetFile = $targetDir . basename($imageName);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if assets directory exists and is writable
    if (!is_dir($targetDir) || !is_writable($targetDir)) {
        echo "Error: The directory $targetDir does not exist or is not writable.";
        exit();
    }

    // Upload image
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        // Display the submitted form data
        echo "<h2>Submitted Form Data</h2>";
        echo "<p><strong>Name:</strong> $name</p>";
        echo "<p><strong>Price:</strong> $price</p>";
        echo "<p><strong>Category ID:</strong> $categoryId</p>";
        echo "<p><strong>Image Name:</strong> $imageName</p>";

        // Display the uploaded image
        echo "<h2>Uploaded Image</h2>";
        echo "<img src='/cafeteria_php/assets/$imageName' alt='Uploaded Image' width='300'>";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

    echo "<p><a href='add_product.php'>Back to Add Product Form</a></p>";
}
