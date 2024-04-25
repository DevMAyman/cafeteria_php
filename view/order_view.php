<?php
include '../helper/db_connection.php';

try {
    $database = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
    $database->connectToDatabase();
    var_dump($database);

} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}