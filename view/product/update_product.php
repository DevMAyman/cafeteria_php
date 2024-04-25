<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <?php include_once '../../helper/base.php'; ?>
    <link href="styles.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5 center-form">
        <h2>Update Product</h2>
        <?php
        include_once '../../model/product_model.php';
        include_once '../../helper/connect_to_db.php';

        $conn = connect_to_db();

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $productData = Product::get_product_by_id($conn, $id);
        }
        ?>
        <form action="../../controller/product_controller.php?action=update" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $productData['id']; ?>">
            <input type="hidden" name="old_image" value="<?php echo $productData['image']; ?>">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $productData['name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" class="form-control" id="price" name="price" min="0" step="0.01" value="<?php echo $productData['price']; ?>" required>
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <select class="form-control" id="category" name="category_id" required>
                    <option value="1" <?php if ($productData['category_id'] == 1) echo 'selected'; ?>>Category 1</option>
                    <option value="2" <?php if ($productData['category_id'] == 2) echo 'selected'; ?>>Category 2</option>
                    <option value="3" <?php if ($productData['category_id'] == 3) echo 'selected'; ?>>Category 3</option>
                </select>
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" class="form-control-file" id="image" name="image">
            </div>
            <div class="form-group">
                <label for="isAvailable">Available:</label>
                <input type="checkbox" id="isAvailable" name="isAvailable" <?php if ($productData['isAvailable']) echo 'checked'; ?>>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="product_dashboard.php" class="btn btn-secondary">Back</a>
            </div>
        </form>
    </div>

</body>

</html>