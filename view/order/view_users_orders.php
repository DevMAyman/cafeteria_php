<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders Dashboard</title>
    <?php include_once '../../helper/base.php'; ?>
    <?php include_once '../../helper/db_connection.php'; ?>
    <link href="styles.css?<?php echo time(); ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Order Dashboard</h2>

        <!-- Filter by order status -->
        <div class="form-group">
            <label for="orderStatus">Filter by Order Status:</label>
            <select id="orderStatus" class="form-control">
                <option value="">select status</option>
                <option value="processing">Processing</option>
                <option value="out_for_delivery">Out for Delivery</option>
                <option value="done">Done</option>
            </select>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Status</th>
                    <th>total price</th>
                    <th>total quantity</th>
                    <th>Actions</th>
                    <th>Products information</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once '../../model/order_model.php';
                require_once '../../model/order_item_model.php';
                require_once '../../model/product_model.php';
                require_once '../../helper/db_connection.php';

                $conn = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
                $conn->connectToDatabase();

                $status = isset($_GET['status']) ? $_GET['status'] : '';

                $sql = "SELECT * FROM orders";
                if (!empty($status)) {
                    $sql .= " WHERE status = :status";
                }
                $stmt = $conn->getPdo()->prepare($sql);
                if (!empty($status)) {
                    $stmt->bindParam(':status', $status);
                }
                $stmt->execute();
                $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($orders as $order) {
                    echo "<tr>";
                    echo "<td>{$order['id']}</td>";
                    echo "<td>{$order['status']}</td>";
                    echo "<td>{$order['total_amount']}</td>";
                    echo "<td>{$order['total_quantity']}</td>";
                    echo "<td><a href='update_order_status_form.php?orderId={$order['id']}'>Update Status</a></td>";
                    echo "<td colspan='3'>";

                    $orderItems = OrderItem::getOrderItemsByOrderId($conn->getPdo(), $order['id']);

                    foreach ($orderItems as $orderItem) {
                        echo "<div>";
                        echo "Product ID: {$orderItem['product_id']} - ";

                        $product = Product::get_product_by_id($conn->getPdo(), $orderItem['product_id']);

                        if ($product) {
                            echo "Product Name: {$product['name']} - ";
                            echo "Quantity: {$orderItem['quantity']} - ";
                            echo "Price: {$orderItem['price']}";
                        } else {
                            echo "Product information not available.";
                        }

                        echo "</div>";
                    }

                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        // JavaScript to handle filter change event
        document.getElementById('orderStatus').addEventListener('change', function () {
            var selectedStatus = this.value;
            window.location.href = '<?php echo $_SERVER['PHP_SELF']; ?>' + '?status=' + selectedStatus;
        });
    </script>

</body>
</html>
