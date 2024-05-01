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
    
    if (isset($_FILES['image'])) {
    $file_name = $_FILES['image']['name'];
    $file_type = $_FILES['image']['type'];
    $file_tmp = $_FILES['image']['tmp_name']; 

    if (empty($file_name)) {
        $errors['image'] = "Image is required.";
    } elseif (!Validation::isImageFile($file_type)) {
        $errors['image'] = "Image must be a valid image file.";
    } else {
        try {
            $upload_path = '../assets/images/';
            $uploaded_file = $upload_path . $file_name;

            if (!file_exists($upload_path)) {
                mkdir($upload_path, 0777, true);
            }

            if (!move_uploaded_file($file_tmp, $uploaded_file)) {
                $errors['image'] = "Failed to upload image.";
            }
        } catch (Exception $e) {
            $errors['image'] = "Error uploading image: " . $e->getMessage();
        }
    }
}

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['formData'] = $formData;

        header("Location: ../view/user_view.php");
        exit; 
    } else {
        UserModel::createUserTable();
        
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $room_no = $_POST['room'];
        $ext = $_POST['ext'];
        $profile_picture = $uploaded_file;
        $role = 'client'; 
        
        if (UserModel::createUser($name, $email, $password, $room_no, $ext, $profile_picture, $role, $profile_picture )) {
            header("Location: ../view/user_management.php");

            exit;
        } else {
            $_SESSION['errors'] = ["Error creating user."];
            header("Location: ../view/user_view.php");
            exit;
        }
    }
}
?>
