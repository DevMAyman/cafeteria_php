<?php

class Database {
    public $conn;

    public function __construct() {
        $config = require('../config.php');
        echo("asdas");
        var_dump ($config);
        $dsn = "mysql:host={$config['host']};dbname={$config['database']}";
        try {
            $this->conn = new PDO($dsn, $config['username'], $config['password']);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function closeConnection() {
        $this->conn = null;
    }

    public function select($table) {
        $sql = "SELECT * FROM {$table}";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
