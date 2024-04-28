<?php
require_once '../helper/db_connection.php';
require_once '../model/order_item_model.php';

class OrderItemController {
    private $conn;

    public function __construct() {
        $this->conn = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        $this->conn->connectToDatabase();
    }

}
