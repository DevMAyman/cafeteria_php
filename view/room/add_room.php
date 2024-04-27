<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Room</title>
    <?php include_once '../../helper/base.php'; ?>
    <link href="styles.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5 center-form">
        <h2>Add Room</h2>
        <form action="../../controller/room_controller.php?action=insert" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="room_name" name="room_name" required>
            </div>
            <div class="form-group">
                <label for="name">Room Number:</label>
                <input type="text" class="form-control" id="room_number" name="room_number" required>
            </div>
            <div class="form-group">
                <label for="name">Is busy:</label>
                <input type="number" class="form-control" id="is_busy" name="is_busy" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
        </form>
    </div>

</body>

</html>