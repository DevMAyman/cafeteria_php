<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
    <?php include_once '../../helper/base.php'; ?>
    <link href="styles.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5 center-form">
        <h2>Add Category</h2>
        <form action="../../controller/category_controller.php?action=add" method="post">
            <div class="form-group">
                <label for="categoryName">Category Name:</label>
                <input type="text" class="form-control" id="categoryName" name="category_name" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Add</button>
                <a href="add_product.php" class="btn btn-secondary">Back</a>
            </div>
        </form>
    </div>

</body>

</html>