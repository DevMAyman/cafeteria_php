<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <?php include_once '../../helper/base.php'; ?>
    <link href="styles.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5 center-form">
        <h2>Add Product</h2>
        <form action="../../controller/product_controller.php?action=insert" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" class="form-control" id="price" name="price" min="0" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <select class="form-control" id="category" name="category_id" required>
                    <?php
                    require_once '../../helper/db_connection.php';
                    require_once '../../model/category_model.php';

                    $db = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
                    $db->connectToDatabase();
                    $conn = $db->getPdo();

                    $categories = Category::get_all_categories($conn);

                    foreach ($categories as $category) {
                        echo '<option value="' . $category['id'] . '">' . $category['name'] . '</option>';
                    }
                    ?>
                </select>
                <a href="./add_category.php" class="btn btn-sm btn-secondary ml-2">Add Category</a>
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" class="form-control-file" id="image" name="image" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
        </form>
    </div>

</body>

</html>