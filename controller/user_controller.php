<?php
session_start(); 

require_once('../helper/validation.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = array();
    $formData = array();
    foreach ($_POST as $key => $value) {
        if ($value == '') {
            $errors[$key] = "$key is required .";
        }
        if ($value != '' && $key != 'image'  && !Validation::validateStringLength($value)) {
            $errors[$key] = "$key must not be more than 100 characters";
        }
        if($key == 'email' && $value != ""&& !Validation::validateEmail($value) ){
            $errors[$key]= "$key is not valid";
        }
        if($key == 'password'  && $value != "" && !Validation::validatePasswordMatch($value,$_POST['confirmPassword']) ){
            $errors[$key]= "$key is not match";
        }
        if($key == 'password'  && $value != "" && !Validation::validatePassword($value) ){
            $errors[$key]= "$key must be more than 8 characters, at least one capital letter, one small letter, one number";
        }
        if($key == 'image'  && $value != "" && !Validation::isImageFile($value) ){
            $errors[$key]= "$key must be an image";
        }

        $formData[$key] = $value;
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['formData'] = $formData;

        header("Location: ../view/user_view.php");
        exit; 
    } else {
        echo "Form submitted successfully!";
    }
}

?>
