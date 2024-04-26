 <?php

    class Category
    {
        private $id;
        private $name;

        public function __construct($name)
        {
            $this->name = $name;
        }

        public function getId()
        {
            return $this->id;
        }

        public function setId($id)
        {
            $this->id = $id;
        }

        public function getName()
        {
            return $this->name;
        }

        public function setName($name)
        {
            $this->name = $name;
        }
        public static function get_all_categories($conn)
        {
            try {
                $stmt = $conn->prepare("SELECT * FROM categories");
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        public function insert_category($conn)
        {
            try {
                $stmt = $conn->prepare("INSERT INTO categories (name) VALUES (:name)");
                $stmt->bindParam(':name', $this->name);
                $stmt->execute();
                $this->id = $conn->lastInsertId();
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }


    ?>