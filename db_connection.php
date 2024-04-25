<?php
const DB_HOST = '127.0.0.1';
const DB_USER = 'nouran';
const DB_PASSWORD = '1234';
const DB_NAME = 'drinks';
const DB_PORT = 3306;
try {
    $dsn = "mysql:host={$this->host};dbname={$this->dbname};port={$this->port}";
    $this->pdo = new PDO($dsn, $this->user, $this->password);
    return $this->pdo;
} catch (PDOException $e) {
    echo "<h3 style='color:red'>{$e->getMessage()}</h3>";
    return false;
}
?>