<?php

function connect_to_db()
{
    $host = 'localhost';
    $dbname = 'cafeteria';  // Replace with your database name
    $username = 'root';  // Replace with your database username
    $password = '';  // Replace with your database password

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        exit();
    }
}
