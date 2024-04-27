<?php
class Validation {
    public static function validateEmail($email) {
        if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true; 
        } else {
            return false; 
        }
    }

      public static function validateStringLength($string, $maxLength = 100) {
        if (!empty($string) && strlen($string) <= $maxLength) {
            return true; 
        } else {
            return false; 
        }
    }

    public static function validatePasswordMatch($password, $confirmPassword) {
        if (!empty($password) && !empty($confirmPassword) && $password === $confirmPassword) {
            return true; 
        } else {
            return false; 
        }
    }

    public static function validatePassword($password) {
        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/';
        if (preg_match($pattern, $password)) {
            return true;
        } else {
            return false;
        }
    }

    public static function isImageFile($file) {
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    if (in_array($file, $allowedTypes)) {
        return true; 
    } else {
        return false;
    }
}
}
?>
