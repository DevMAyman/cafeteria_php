<?php
require_once '../helper/db_connection.php';
require_once '../model/order_item_model.php';
require_once '../model/product_model.php';

class Order
{
    // Your existing methods and properties here...
  
    // Existing methods...

    public static function getUserOrders($conn, $userId)
    {
        try {
            $stmt = $conn->getPdo()->prepare("SELECT * FROM orders WHERE user_id = :userId");
            $stmt->bindParam(':userId', $userId);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error fetching user orders: " . $e->getMessage());
            return null;
        }
    }
}

$conn = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
// Establish database connection
if (!$conn->connectToDatabase()) {
    echo "Failed to connect to the database.";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders Dashboard</title>
    <?php include_once '../helper/base.php'; ?>
    <?php include_once '../helper/db_connection.php'; ?>
    <link href="styles.css?<?php echo time(); ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        td a {
            text-decoration: none;
            color: #007bff;
        }
        td a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Your Orders</h2>

        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Status</th>
                    <th>Total Price</th>
                    <th>Total Quantity</th>
                    <th>Products Information</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $userId = 1; // Example user ID

                $orders = Order::getUserOrders($conn, $userId);

                foreach ($orders as $order) {
                    echo "<tr>";
                    echo "<td>{$order['id']}</td>";
                    echo "<td>{$order['status']}</td>";
                    echo "<td>{$order['total_amount']}</td>";
                    echo "<td>{$order['total_quantity']}</td>";
                    echo "<td>";

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

</body>
</html>
