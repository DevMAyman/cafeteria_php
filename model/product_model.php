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
}
