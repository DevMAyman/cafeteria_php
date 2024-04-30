<?php
require_once __DIR__ . '/../config.php';

if (!class_exists('Database')) {
    class Database
    {
        private $host;
        private $dbname;
        private $username;
        private $password;
        private $pdo;

        public function __construct($host, $dbname, $username, $password)
        {
            $this->host = $host;
            $this->dbname = $dbname;
            $this->username = $username;
            $this->password = $password;
        }

        public function connectToDatabase()
        {
            try {
                $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4";
                $this->pdo = new PDO($dsn, $this->username, $this->password);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $this->pdo;
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }
        public function prepare($sql)
        {
            return $this->pdo->prepare($sql);
        }
        public function lastInsertId()
        {
            return $this->pdo->lastInsertId();
        }
        public function getPdo()
        {
            return $this->pdo;
        }

        public function select($table)
        {
            $sql = "SELECT * FROM {$table}";
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

     public function closeConnection() {
        $this->pdo = null;
    }

     public function closeConnection() {
        $this->pdo = null;
    }
}
