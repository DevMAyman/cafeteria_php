<?php

class Product
{
    private $id;
    private $name;
    private $price;
    private $image;
    private $isAvailable;
    private $categoryId;

    public function __construct($id, $name, $price, $image, $isAvailable, $categoryId)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->image = $image;
        $this->isAvailable = $isAvailable;
        $this->categoryId = $categoryId;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getIsAvailable()
    {
        return $this->isAvailable;
    }

    public function getCategoryId()
    {
        return $this->categoryId;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function setIsAvailable($isAvailable)
    {
        $this->isAvailable = $isAvailable;
    }

    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
    }

    // CRUD operations

    public static function get_all_Products($conn)
    {
        $stmt = $conn->query("SELECT * FROM products2");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function get_product_by_id($conn, $id)
    {
        $stmt = $conn->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insert_product($conn)
    {
        $stmt = $conn->prepare("INSERT INTO products (name, price, image, isAvailable, category_id) VALUES (:name, :price, :image, :isAvailable, :category_id)");
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':image', $this->image);
        $stmt->bindParam(':isAvailable', $this->isAvailable);
        $stmt->bindParam(':category_id', $this->categoryId);
        $stmt->execute();
        $this->id = $conn->lastInsertId();
    }

    public function update_product($conn)
    {
        $stmt = $conn->prepare("UPDATE products SET name = :name, price = :price, image = :image, isAvailable = :isAvailable, category_id = :category_id WHERE id = :id");
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':image', $this->image);
        $stmt->bindParam(':isAvailable', $this->isAvailable);
        $stmt->bindParam(':category_id', $this->categoryId);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
    }

    public static function delete_product($conn, $id)
    {
        $stmt = $conn->prepare("DELETE FROM products WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
