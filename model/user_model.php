<?php
// require_once('../helper/db_connection.php');
// require_once('Cloudinary.php');

class UserModel  {
     public static function createUserTable(){
         try {
            $pdo = new PDO('mysql:host=127.0.0.1;dbname=myusers;charset=utf8', 'root', 'mysql@123');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
        try {
            $sql = "CREATE TABLE IF NOT EXISTS myusers.users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL UNIQUE,
                password VARCHAR(255) NOT NULL,
                room_no VARCHAR(50) NOT NULL,
                ext VARCHAR(50),
                profile_picture VARCHAR(255),
                role ENUM('client', 'admin') NOT NULL DEFAULT 'client'
            )";
            $pdo->exec($sql);
            echo "Table created successfully!";
        } catch (PDOException $e) {
            die("Error creating user table: " . $e->getMessage());
        }
        $pdo = null;
    }
    public static function createUser($name, $email, $password, $room_no, $ext, $profile_picture, $role) {
        try {
            $pdo = new PDO('mysql:host=127.0.0.1;dbname=myusers;charset=utf8', 'root', 'mysql@123');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (name, email, password, room_no, ext, profile_picture, role) VALUES (?, ?, ?, ?, ?, ?, ?)");

            $stmt->bindParam(1, $name);
            $stmt->bindParam(2, $email);
            $stmt->bindParam(3, $hashed_password);
            $stmt->bindParam(4, $room_no);
            $stmt->bindParam(5, $ext);
            $stmt->bindParam(6, $profile_picture);
            $stmt->bindParam(7, $role);

            $stmt->execute();

            $pdo = null;

            return true;
        } catch (PDOException $e) {
            error_log("Error creating user: " . $e->getMessage());
            return false;
        }
    }

    public static function  get_all_users() {
    try {
        try {
            $pdo = new PDO('mysql:host=127.0.0.1;dbname=myusers;charset=utf8', 'root', 'mysql@123');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }

        $stmt = $pdo->prepare("SELECT * FROM users");

        $stmt->execute();

        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $pdo = null;

        return $users;
    } catch (PDOException $e) {
        die("Error retrieving users: " . $e->getMessage());
    }
}

    public static function delete_user($user_id) {
    try {
         try {
            $pdo = new PDO('mysql:host=127.0.0.1;dbname=myusers;charset=utf8', 'root', 'mysql@123');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }

        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");

        $stmt->bindParam(1, $user_id);

        $stmt->execute();
        
        $pdo = null;
    } catch (PDOException $e) {
        trigger_error("Error deleting user: " . $e->getMessage());
    }
}

  public static function get_user_by_id($user_id) {
    try {
        $pdo = new PDO('mysql:host=127.0.0.1;dbname=myusers;charset=utf8', 'root', 'mysql@123');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
    $stmt = $pdo->prepare('SELECT * FROM users WHERE id = :user_id');

    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    $pdo = null;

    return $user ? $user : false;
}

}



?>
