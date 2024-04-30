<?php
    session_start();
  
include '../helper/db_connection.php';
require_once('../helper/validation.php');
require_once('../config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = array();
    $formData = array();
    
    // Validate email and password
   foreach ($_POST as $key => $value) {
       if ($value == '') {
            $errors[$key] = "$key is required.";
        }
        if ($key == 'email' && $value != "" && !Validation::validateEmail($value)) {
            $errors[$key] = "$key is not valid.";
       }
      // if ($key == 'password' && $value != "" && !Validation::validateStringLength($value, 8)) {
       //   $errors[$key] = "$key must be at least 8 characters long.";
       // }

        $formData[$key] = $value;
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['formData'] = $formData;

        header("Location: ../view/login_view.php");
        exit; 
    } else {
        // Connect to the database
        $database = new Database(DB_HOST, DB_NAME, DB_USERNAME , DB_PASSWORD);
        $database->connectToDatabase();
        
        // Check if the email and password exist in the database
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $query = "SELECT * FROM users WHERE email = :email AND password = :password";
        $statement = $database->getPdo()->prepare($query);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':password', $password);
        $statement->execute();
        
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        
        if ($user) {
            $_SESSION['email'] = $email;
            header("Location: ../view/home_view.php");
            exit;
        } else {
        
            $errors['login'] = "Invalid email or password.";
            $_SESSION['errors'] = $errors;
            $_SESSION['formData'] = $formData;
            header("Location: ../view/login_view.php");
            exit;
        }
    }
}
?>
