<?php
require_once '../helper/db_connection.php';  

function isAdmin() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $isLoggedIn = isset($_SESSION['email']);

    $isAdmin = false; 
    if ($isLoggedIn) {
        $database = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
        $database->connectToDatabase();
        
        $email = $_SESSION['email'];
        $query = "SELECT * FROM users WHERE name = 'admin' AND email = :email";
        $statement = $database->getPdo()->prepare($query);
        $statement->bindParam(':email', $email);
        $statement->execute();
        
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        
        if ($user) {
            $isAdmin = true;
        }
    }
    return $isAdmin;
}

 function access_image(){
     
    $isLoggedIn = isset($_SESSION['email']);

   
    if ($isLoggedIn) {
        $database = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
        $database->connectToDatabase();
        
        $email = $_SESSION['email'];
        $query = "SELECT * FROM users WHERE  email = :email";
        $statement = $database->getPdo()->prepare($query);
        $statement->bindParam(':email', $email);
        $statement->execute();
        
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        $imagePath = $user['image'];
    }
    return $imagePath;
 }
?>
