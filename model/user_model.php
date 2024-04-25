<?php
require_once('../helper/database.php');
require_once('Cloudinary.php');

class UserModel extends Database {
    public function createUser($name, $email, $password, $role, $imagePath) {
        $name = htmlspecialchars(strip_tags($name));
        $email = htmlspecialchars(strip_tags($email));
        $password = password_hash($password, PASSWORD_DEFAULT); // Hash the password
        $role = htmlspecialchars(strip_tags($role));
        
        $cloudinary = new Cloudinary();
        $imageURL = $cloudinary->uploadImage($imagePath);

        $sql = "INSERT INTO users (name, email, password, role, image_url) VALUES (:name, :email, :password, :role, :imageURL)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':imageURL', $imageURL);

        try {
            $stmt->execute();
            return true; 
        } catch (PDOException $e) {
            return false; 
        }
    }

    public function getUserById($id) {
        $id = (int)$id;

        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ? $user : null;
    }

    public function updateUser($id, $name, $email, $role, $imagePath = null) {
        $id = (int)$id;
        $name = htmlspecialchars(strip_tags($name));
        $email = htmlspecialchars(strip_tags($email));
        $role = htmlspecialchars(strip_tags($role));

        if ($imagePath) {
            $cloudinary = new Cloudinary();
            $imageURL = $cloudinary->uploadImage($imagePath);
            $sql = "UPDATE users SET name=:name, email=:email, role=:role, image_url=:imageURL WHERE id=:id";
        } else {
            $sql = "UPDATE users SET name=:name, email=:email, role=:role WHERE id=:id";
        }

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':id', $id);
        if ($imagePath) {
            $stmt->bindParam(':imageURL', $imageURL);
        }

        try {
            $stmt->execute();
            return true; 
        } catch (PDOException $e) {
            return false; 
        }
    }

    public function deleteUser($id) {
        $id = (int)$id;

        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);

        try {
            $stmt->execute();
            return true; 
        } catch (PDOException $e) {
            return false; 
        }
    }
}

?>
