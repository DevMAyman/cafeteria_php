<?php
require '../config.php';

class Database {
    private $host;
    private $dbname;
    private $username;
    private $password;
    private $pdo;
    private $port;

    public function __construct($host, $dbname, $username, $password,$port) {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;
        $this->port = $port;

    }

    public function connectToDatabase() {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbname};port={$this->port}";
            $this->pdo = new PDO($dsn, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
    public function select($table) {
        $sql = "SELECT * FROM {$table}";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // public function getPdo() {
    //     return $this->pdo;
    // }
}
?>
