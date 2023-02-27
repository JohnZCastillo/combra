<?php


use db\ProductDb;
use Exception;

try {

    $json = file_get_contents('php://input');

    // Converts it into a PHP object
    $data = json_decode($json, true);

    // throw an error if image is missing
    if (!isset($data['id'])) {
        throw new Exception("Missing ID");
    }

    $id = $data['id'];
    //save product to database
    ProductDb::deleteProductById($id);

    //return profile name
    echo json_encode(['message' => $id]);
    die();
} catch (Exception $e) {
    http_response_code(403);
    echo json_encode(['message' => $e->getMessage()]);
    die();
}
