<?php
class Validation {
    public static function validateEmail($email) {
        if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true; // Email is valid
        } else {
            return false; // Email is invalid
        }
    }

      public static function validateStringLength($string, $maxLength = 100) {
        // Check if the string is not empty and its length is less than or equal to the specified max length
        if (!empty($string) && strlen($string) <= $maxLength) {
            return true; // String length is valid
        } else {
            return false; // String length is invalid
        }
    }

    public static function validatePasswordMatch($password, $confirmPassword) {
        // Check if both passwords are not empty and they match
        if (!empty($password) && !empty($confirmPassword) && $password === $confirmPassword) {
            return true; // Passwords match
        } else {
            return false; // Passwords don't match
        }
    }

    public static function validatePassword($password) {
        // Define the regular expression pattern to validate the password
        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/';

        // Check if the password matches the pattern
        if (preg_match($pattern, $password)) {
            return true; // Password meets the criteria
        } else {
            return false; // Password does not meet the criteria
        }
    }

    public static function isImageFile($file) {
        // Check if the file is an image
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif','image/webp'];
        
        // Check if the file type is in the list of allowed types
        if (in_array($file['type'], $allowedTypes)) {
            return true; // File is an image
        } else {
            return false; // File is not an image
        }
    }
}
?>
