<?php

namespace db;

use Exception;
use db\Database;
use model\product\Product;

require_once 'autoload.php';


class ProductDb
{

    static function addProduct(Product $product)
    {

        // check if name is already in db
        if (self::isNameInUsed($product->getName())) {
            throw new Exception('product name is already present in db');
        }

        $connection = Database::open();

        $stmt = $connection->prepare("INSERT INTO product (name, description, price, category, stock, image_path) values(?,?,?,?,?,?)");

        $name = $product->getName();
        $description = $product->getDescription();
        $price = $product->getPrice();
        $category = $product->getCategory();
        $stock = $product->getStock();
        $imagePath = $product->getImagePath();

        $stmt->bind_param("ssdsds", $name, $description, $price, $category, $stock, $imagePath);

        $stmt->execute();

        $error = mysqli_error($connection);

        $stmt = $connection->prepare("select last_insert_id() as id");

        $stmt->execute();

        //get result
        $result = $stmt->get_result();

        // store result in array
        $data = $result->fetch_assoc();

        $product->setId($data["id"]);

        Database::close($connection);

        return $error;
    }


    // get the product from db base on id
    // if id is not present this trigger an error
    static function getProductById($id)
    {
        // open database connection
        $conn = Database::open();

        $stmt = $conn->prepare("SELECT * FROM product WHERE id = ?");

        // set the ?'s mark data to parameter's data
        $stmt->bind_param("s", $id);

        // execute prepared statement
        $stmt->execute();

        //get result
        $result = $stmt->get_result();

        // store result in array
        $data = $result->fetch_assoc();

        // throw an exception data is null that means username is not present in db
        if ($data == null) {
            Database::close($conn);
            throw new Exception('Product not found | Invalid Connection');
        }

        Database::close($conn);

        //create product class base on db collected;
        $product = new Product($data['name'], $data['description'], $data['price'], $data['category'], $data['stock'], $data['image_path']);

        // set the product id base on the db's data 
        $product->setId($data['id']);

        return $product;
    }

    // upaate products details on db
    static function updateProduct(Product $product)
    {

        $connection = Database::open();

        $stmt = $connection->prepare("UPDATE product set name = ?, description = ?,  price = ?, category = ?,stock = ? WHERE id = ?");

        $id = $product->getId();
        $name = $product->getName();
        $description = $product->getDescription();
        $price = $product->getPrice();
        $category = $product->getCategory();
        $stock = $product->getStock();
        $imagePath = $product->getImagePath();

        $stmt->bind_param("ssdssd", $name, $description, $price, $category, $stock, $id);
        $stmt->execute();

        $error = mysqli_error($connection);

        Database::close($connection);

        if ($error !== null && $error !== '') {
            throw new Exception("Update Failed | check if product exist");
        }
    }

    // upaate products details on db
    static function updateProductImage(Product $product)
    {

        $connection = Database::open();

        $stmt = $connection->prepare("UPDATE product set name = ?, description = ?,  price = ?, category = ?,stock = ?, image_path = ? WHERE id = ?");

        $id = $product->getId();
        $name = $product->getName();
        $description = $product->getDescription();
        $price = $product->getPrice();
        $category = $product->getCategory();
        $stock = $product->getStock();
        $imagePath = $product->getImagePath();

        $stmt->bind_param("ssdsssd", $name, $description, $price, $category, $stock, $imagePath, $id);
        $stmt->execute();

        $error = mysqli_error($connection);

        Database::close($connection);

        if ($error !== null && $error !== '') {
            throw new Exception("Update Failed | check if product exist");
        }
    }


    static function getAllProducts()
    {

        //open database connection
        $conn = Database::open();

        $stmt = $conn->prepare("SELECT * FROM product");

        // execute prepared statement
        $stmt->execute();

        //get result
        $result = $stmt->get_result();

        $products = array();

        while ($data = $result->fetch_assoc()) {
            //create product class base on db collected;
            $product = new Product($data['name'], $data['description'], $data['price'], $data['category'], $data['stock'], $data['image_path']);

            // set the product id base on the db's data 
            $product->setId($data['id']);

            array_push($products, $product);
        }

        Database::close($conn);

        // throw an exception data is null that means username is not present in db
        if ($products == null) {
            throw new Exception('No Products Found');
        }

        return $products;
    }

    static function isNameInUsed($name)
    {
        // open database connection
        $conn = Database::open();

        $stmt = $conn->prepare("SELECT name FROM product WHERE name = ?");

        // set the ?'s mark data to parameter's data
        $stmt->bind_param("s", $name);

        // execute prepared statement
        $stmt->execute();

        //get result
        $result = $stmt->get_result();

        // store result in array
        $data = $result->fetch_assoc();

        Database::close($conn);

        // return false if name is not in db
        if ($data == null) {
            return false;
        }

        // return true if name is in db
        return true;
    }

    static function deleteProductById($id)
    {

        $connection = Database::open();

        $stmt = $connection->prepare("DELETE FROM product WHERE id = ?");

        $stmt->bind_param("s", $id);

        $stmt->execute();

        $error = mysqli_error($connection);

        Database::close($connection);

        if ($error !== null && $error !== '') {
            throw new Exception($error);
        }
    }
}
