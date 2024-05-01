<?php
session_start();
  
include '../helper/db_connection.php';
require_once('../helper/validation.php');
require_once('../config.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
        if ($key == 'password' && $value != "" && !Validation::validateStringLength($value, 8)) {
            $errors[$key] = "$key must be at least 8 characters long.";
        }

        $formData[$key] = $value;
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['formData'] = $formData;

        header("Location: ../view/login_view.php");
        exit; 
    } else {
        // Connect to the database
        $database = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        try {
            $database->connectToDatabase();
            
            // Check if the email exists in the database
            $email = $_POST['email'];
            $query = "SELECT * FROM users WHERE email = :email";
            $statement = $database->getPdo()->prepare($query);
            $statement->bindParam(':email', $email);
            $statement->execute();
            
            $user = $statement->fetch(PDO::FETCH_ASSOC);
            
            if ($user) {
                // Verify the password
                $password = $_POST['password'];
                if (password_verify($password, $user['password'])) {
                    $_SESSION['user'] = $user;
                    header("Location: ../view/home_view.php");
                    exit;
                } else {
                    $errors['login'] = "Invalid email or password.";
                }
            } else {
                $errors['login'] = "Invalid email or password.";
            }
        } catch (PDOException $e) {
            $errors['database'] = "Database error: " . $e->getMessage();
        } finally {
            $database->closeConnection();
        }
        
        $_SESSION['errors'] = $errors;
        $_SESSION['formData'] = $formData;
        header("Location: ../view/login_view.php");
        exit;
    }
}
?>
