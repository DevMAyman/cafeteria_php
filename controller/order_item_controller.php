<?php
require_once '../helper/db_connection.php';
require_once '../model/order_item_model.php';

class OrderItemController {
    private $db;

    public function __construct() {
        $this->db = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        $this->db->connectToDatabase();
    }

    public function createOrderItem($quantity, $price, $order_id, $product_id) {
        try {
            $orderItem = new OrderItem($quantity, $price, $order_id, $product_id);
    
            $stmt = $this->db->getPdo()->prepare("INSERT INTO order_items (quantity, price, order_id, product_id) VALUES (?, ?, ?, ?)");
            $stmt->execute([$orderItem->getQuantity(), $orderItem->getPrice(), $orderItem->getOrderId(), $orderItem->getProductId()]);
    
            if ($stmt->rowCount() > 0) {
                return true; 
            } else {
                return false;
            }
        } catch (PDOException $e) {
            die("Error creating order item: " . $e->getMessage());
        }
    }    

    public function getOrderItemById($id) {
        try {
            $stmt = $this->db->getPdo()->prepare("SELECT * FROM order_items WHERE id = ?");
            $stmt->execute([$id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($result) {
                var_dump($result);
                return new OrderItem($result['id'],$result['quantity'], $result['price'], $result['order_id'], $result['product_id']);
            } else {
                return null;
            }
        } catch (PDOException $e) {
            die("Error fetching order item: " . $e->getMessage());
        }
    }
    

    public function updateOrderItem(OrderItem $orderItem) {
        try {
            $stmt = $this->db->getPdo()->prepare("UPDATE order_items SET quantity = ?, price = ?, order_id = ?, product_id = ? WHERE id = ?");
            $stmt->execute([$orderItem->getQuantity(), $orderItem->getPrice(), $orderItem->getOrderId(), $orderItem->getProductId(), $orderItem->getId()]);

            if ($stmt->rowCount() > 0) {
                return true; 
            } else {
                return false; 
            }
        } catch (PDOException $e) {
            die("Error updating order item: " . $e->getMessage());
        }
    }

    public function deleteOrderItem($id) {
        try {
            $stmt = $this->db->getPdo()->prepare("DELETE FROM order_items WHERE id = ?");
            $stmt->execute([$id]);

            if ($stmt->rowCount() > 0) {
                return true; 
            } else {
                return false;
            }
        } catch (PDOException $e) {
            die("Error deleting order item: " . $e->getMessage());
        }
    }
}

//                      example to test controller functionality
// $orderItemController = new OrderItemController();

// // // Create a new order item
// // $result = $orderItemController->createOrderItem(4, 2, 1, 124);

// // if ($result) {
// //     echo "Order item created successfully!";
// // } else {
// //     echo "Failed to create order item.";
// // }

// // Retrieve an order item by ID (test this functionality)
// $orderItem = $orderItemController->getOrderItemById(2);

// if ($orderItem) {
//     echo "Found order item with ID: " . $orderItem->getId();
//     // Update the retrieved order item (test update functionality)
//     // $orderItem->setQuantity(3);
//     // $orderItem->setPrice(15.99);
//     // $updateResult = $orderItemController->updateOrderItem($orderItem);

//     // if ($updateResult) {
//     //     echo "Order item updated successfully!";
//     // } else {
//     //     echo "Failed to update order item.";
//     // }

//     // // Delete the order item (test delete functionality)
//     // $deleteResult = $orderItemController->deleteOrderItem($orderItem->getId());

//     // if ($deleteResult) {
//     //     echo "Order item deleted successfully!";
//     // } else {
//     //     echo "Failed to delete order item.";
//     // }
// } else {
//     echo "Order item not found.";
// }
?>
