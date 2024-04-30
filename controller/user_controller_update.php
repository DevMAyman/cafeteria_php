<?php
session_start(); 

require_once('../helper/validation.php');
require_once('../model/user_model.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];
    $formData = [];

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
                default:
                    $formData[$key] = $value;
                    break;
            }
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

        header("Location: ../view/update_user_form.php");
        exit; 
    } else {
        $user_id = $_POST['user_id']; 
        $name = $_POST['name'];
        $email = $_POST['email'];
        $room_no = $_POST['room'];
        $ext = $_POST['ext'];
        $profile_picture = isset($uploaded_file) ? $uploaded_file : ''; 
        $role = 'client'; 
        
        if (UserModel::updateUser($user_id, $name, $email, $room_no, $ext, $profile_picture, $role)) {
            header("Location: ../view/user_management.php");
            exit;
        } else {
            // If update fails, redirect back to update form with user_id
            $_SESSION['errors'] = ["Error updating user."];
            $_SESSION['formData'] = $formData; // Preserve form data
            $_SESSION['user_id'] = $user_id; // Preserve user_id
            header("Location: ../view/update_user_form.php");
            exit;
        }
    }
}
?>
