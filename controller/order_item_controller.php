<?php
require_once '../helper/db_connection.php';
require_once '../model/order_item_model.php';
require_once '../model/order_model.php';
require_once '../base.php';
require_once '../helper/table_exist.php';



class OrderItemController
{


    private $conn;

    public function __construct()
    {
        $this->conn = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        $this->conn->connectToDatabase();
        // orderItemsTableExist($this->conn->getPdo());
        // ordersTableExist($this->conn->getPdo());
    }

    public function addOrderItem()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $temp_order_id = -1;

        if (!isset($_SESSION['order_items'])) {
            $_SESSION['order_items'] = [];
        }


        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];
        $product_price = $_POST['product_price'];

        $order_item = [
            'order_id' => $temp_order_id,
            'product_id' => $product_id,
            'quantity' => $quantity,
            'price' => $product_price
        ];

        // Log session data for debugging
        error_log(print_r($_SESSION, true)); // Logs the current session data

        $_SESSION['order_items'][] = $order_item; // Add the new order item

        $last_added_item = $_SESSION['order_items'][count($_SESSION['order_items']) - 1];
        echo json_encode($last_added_item); // Return the last added item as a JSON response


        echo json_encode(array("status" => "success", "message" => "Item added to order."));
    }

    public function calculateTotalAmountAndQuantity($order_items)
    {
        $total_amount = 0;
        $total_quantity = 0;

        foreach ($order_items as $item) {
            $item_total = $item['quantity'] * $item['price'];
            $total_amount += $item_total;
            $total_quantity += $item['quantity'];
        }

        return [
            'total_amount' => $total_amount,
            'total_quantity' => $total_quantity
        ];
    }


    public function placeOrder($roomId, $notes)
    {
        $user = $_SESSION["user"];
        // var_dump([$user['user_id']]);
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $user = $_SESSION["user"];
        $userId = $user["id"];
        if (isset($_SESSION['order_items'])) {
            $totals = $this->calculateTotalAmountAndQuantity($_SESSION['order_items']);

            $total_amount = $totals['total_amount'];
            $total_quantity = $totals['total_quantity'];

            $order = new Order(
                $total_amount,
                $notes,
                'pending',
                date("Y-m-d H:i:s"),
                $total_quantity,
                $roomId,
                $userId
            );
            var_dump($order);
            // $_SESSION['user_id']
            $order_added = $order->addOrder($this->conn->getPdo());

            if ($order_added) {
                $final_order_id = $order->getId();
                $stmt = $this->conn->getPdo()->prepare("UPDATE rooms SET is_busy = 1 WHERE id = :room_id");
                $stmt->bindParam(':room_id', $roomId);
                $stmt->execute();

                foreach ($_SESSION['order_items'] as &$item) {
                    $item['order_id'] = $final_order_id;
                    $orderItem = new OrderItem(
                        null,
                        $item['quantity'],
                        $item['price'],
                        $final_order_id,
                        $item['product_id']
                    );
                    $orderItem->addOrderItem($this->conn->getPdo());
                    var_dump($orderItem);
                }

                unset($_SESSION['order_items']);
                echo json_encode(array("status" => "success", "message" => "Order placed successfully."));
            } else {
                echo json_encode(array("status" => "error", "message" => "Failed to place the order."));
            }
        } else {
            echo json_encode(array("status" => "error", "message" => "No order items to place."));
        }
    }
}
