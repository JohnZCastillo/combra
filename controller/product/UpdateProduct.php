<?php

namespace controller\product;

use db\ProductDb;
use Exception;
use model\product\Product;

session_start();

try {

    // create an instance of product
    $product = new Product($_POST['name'], $_POST['description'], $_POST['price'], $_POST['category'], $_POST['stock'],  $_POST['image']);

    //update id
    $product->setId($_POST['id']);

    // throw an error if image is missing
    if (isset($_FILES['sample_image'])) {

        // path where images will ba saved
        $imagePath = './assets/product/';

        $extension = pathinfo($_FILES['sample_image']['name'], PATHINFO_EXTENSION);
        $imageName = $product->getName() .  '.' . $extension;

        move_uploaded_file($_FILES['sample_image']['tmp_name'], $imagePath . $imageName);

        // set image
        $product->setImagePath($imagePath . $imageName);
    }

    //update product to database
    ProductDb::updateProduct($product);

    //return profile name
    echo json_encode(['message' => $product]);
    die();
} catch (Exception $e) {
    http_response_code(403);
    echo json_encode(['message' => $e->getMessage()]);
    die();
}
