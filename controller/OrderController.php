<?php

include '../helper/db_connection.php';
include '../model/order_model.php';
class OrderController
{
  private $conn;

  public function __construct()
    {
        $this->conn = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        $this->conn->connectToDatabase();
    }
}
