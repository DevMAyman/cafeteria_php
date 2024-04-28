<?php
session_start(); 

require_once('../helper/validation.php');
require_once('../model/user_model.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize variables
    $errors = [];
    $formData = [];

    // Validate form data
    foreach ($_POST as $key => $value) {
        if ($value == '') {
            $errors[$key] = "$key is required.";
        } else {
            switch ($key) {
                case 'name':
                    if (!Validation::validateStringLength($value)) {
                        $errors[$key] = "$key must not be more than 100 characters.";
                    }
                    break;
                case 'email':
                    if (!Validation::validateEmail($value)) {
                        $errors[$key] = "$key is not valid.";
                    }
                    break;
                case 'password':
                    if (!Validation::validatePasswordMatch($value, $_POST['confirmPassword'])) {
                        $errors[$key] = "$key does not match.";
                    } elseif (!Validation::validatePassword($value)) {
                        $errors[$key] = "$key must be more than 8 characters and contain at least one capital letter, one small letter, and one number.";
                    }
                    break;
                default:
                    $formData[$key] = $value;
                    break;
            }
            // Store valid form data
            $formData[$key] = $value;
        }
    }
    
    // Validate image
    if (isset($_FILES['image'])) {
        $file_name = $_FILES['image']['name'];
        $file_type = $_FILES['image']['type'];

        if (empty($file_name)) {
            $errors['image'] = "Image is required.";
        } else {
            if (!Validation::isImageFile($file_type)) {
                $errors['image'] = "Image must be a valid image file.";
            }
        }
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['formData'] = $formData;

        header("Location: ../view/user_view.php");
        exit; 
    } else {
        // Create user table if not exists
        UserModel::createUserTable();
        
        // Extract form data
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $room_no = $_POST['room'];
        $ext = $_POST['ext'];
        $profile_picture = ''; // Not sure where you're getting this from in the form
        $role = 'client'; // Assuming a default role
        
        // Create user
        if (UserModel::createUser($name, $email, $password, $room_no, $ext, $profile_picture, $role)) {
            // User created successfully, redirect to another page
            // header("Location: ../view/success.php");
            header("Location: ../view/user_management.php");

            exit;
        } else {
            // User creation failed, handle accordingly
            $_SESSION['errors'] = ["Error creating user."];
            header("Location: ../view/user_view.php");
            exit;
        }
    }
}
?>
