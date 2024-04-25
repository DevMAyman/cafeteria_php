<?php

function connect_to_db()
{
    $host = 'localhost';
    $dbname = 'cafeteria';
    $username = 'root';
    $password = '';

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo "<h3 style='color:red'>Connection failed: " . $e->getMessage() . "</h3>";
        exit();
    }
}
