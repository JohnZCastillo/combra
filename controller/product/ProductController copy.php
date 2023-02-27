<?php

namespace controller\product;

use Exception;
use db\ProductDb;
use model\product\Product;


try {

    // throw an error if image is missing
    if (!isset($_FILES['sample_image'])) {
        throw new Exception("Missing Image");
    }

    $product = new Product($_POST['name'], $_POST['description'], $_POST['price'], $_POST['category'], $_POST['stock'], "not set");

    // path where images will ba saved
    $imagePath = './assets/product/';

    $extension = pathinfo($_FILES['sample_image']['name'], PATHINFO_EXTENSION);
    $imageName = $product->getName() .  '.' . $extension;

    move_uploaded_file($_FILES['sample_image']['tmp_name'], $imagePath . $imageName);

    // set image
    $product->setImagePath($imagePath . $imageName);

    //save product to database
    ProductDb::addProduct($product);

    echo json_encode(['message' => $product]);
    die();
} catch (Exception $e) {
    http_response_code(403);
    echo json_encode(['message' => $e->getMessage()]);
    die();
}
