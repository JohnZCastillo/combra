<?php

namespace model\product;

use controller\util\Util;
use JsonSerializable;

class Product  implements JsonSerializable
{

    private  $id;
    private  $name;
    private  $description;
    private  $price;
    private  $category;
    private  $stock;
    private  $imagePath;

    public function __construct($name, $description, $price, $category, $stock, $imagePath)
    {
        // $this->id = Util::generateId();
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->category = $category;
        $this->stock = $stock;
        $this->imagePath = $imagePath;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function getStock()
    {
        return $this->stock;
    }

    public function getImagePath()
    {
        return $this->imagePath;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function setDescription($description): void
    {
        $this->description = $description;
    }

    public function setPrice($price): void
    {
        $this->price = $price;
    }

    public function setCategory($category): void
    {
        $this->category = $category;
    }

    public function setStock($stock): void
    {
        $this->stock = $stock;
    }

    public function setImagePath($imagePath): void
    {
        $this->imagePath = $imagePath;
    }
    public function jsonSerialize()
    {
        return
            [
                'id'   => $this->getId(),
                'name' => $this->getName(),
                'description' => $this->getDescription(),
                'price' => $this->getPrice(),
                'category' => $this->getCategory(),
                'stock' => $this->getStock(),
                'imagePath' => $this->getImagePath(),
            ];
    }
}
