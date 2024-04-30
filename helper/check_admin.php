<?php
require_once '../helper/db_connection.php';  

function isAdmin() {
    try {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

       // echo "Session email: " . $_SESSION['email'] . "<br>";

        $isLoggedIn = isset($_SESSION['email']);

        $isAdmin = false; 
        if ($isLoggedIn) {
            $database = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
            $database->connectToDatabase();
            
            $email = $_SESSION['email'];
            $query = "SELECT * FROM users WHERE email = :email AND role = 'admin'";
            $statement = $database->getPdo()->prepare($query);
            $statement->bindParam(':email', $email);
            $statement->execute();
            
            $user = $statement->fetch(PDO::FETCH_ASSOC);
             
            
            if ($user) {
                $isAdmin = true;
            }
        }
        return $isAdmin;
    } catch (PDOException $e) {
         error_log("Error in isAdmin(): " . $e->getMessage());
         return false;
    }
}





 function access_image(){
     
    $isLoggedIn = isset($_SESSION['email']);

   
    if ($isLoggedIn) {
        $database = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        $database->connectToDatabase();
        
        $email = $_SESSION['email'];
        $query = "SELECT * FROM users WHERE  email = :email";
        $statement = $database->getPdo()->prepare($query);
        $statement->bindParam(':email', $email);
        $statement->execute();
        
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        $imagePath = $user['profile_picture'];
    }
    return $imagePath;
 }
?>
