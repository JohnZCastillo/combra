<?php

// Act as a router.
$request = $_SERVER['REQUEST_URI'];

require_once './autoload.php';

// folder inside htdocs.
// check htaccess.
$base = '/combra/';

// reroute request to views.
switch ($request) {
    case $base:
        require __DIR__ . '/views/home.php';
        break;
    case $base . 'login':
        require __DIR__ . '/views/login.php';
        break;
    case $base . 'signup':
        require __DIR__ . '/views/signup.php';
        break;
    case $base . 'auth':
        require __DIR__ . '/controller/security/Login.php';
        break;
    case $base . 'admin':
        require __DIR__ . '/views/admin/admin.php';
        break;
    case $base . 'logout':
        require __DIR__ . '/controller/security/Logout.php';
        break;
    case $base . 'redirect':
        require __DIR__ . '/controller/security/Redirect.php';
        break;
    case $base . 'register':
        require __DIR__ . '/controller/security/RegisterUser.php';
        break;
    case $base . 'cart':
        require __DIR__ . '/views/cart.php';
        break;
    case $base . 'category':
        require __DIR__ . '/views/category.php';
        break;
    case $base . 'product-controller':
        require __DIR__ . '/controller/product/ProductController.php';
        break;
    case $base . 'update-product':
        require __DIR__ . '/controller/product/UpdateProduct.php';
        break;
    case $base . 'delete-product':
        require __DIR__ . '/controller/product/DeleteProduct.php';
        break;
    case $base . 'home':
        require __DIR__ . '/views/home.php';
        break;
    case $base . 'home?' . $_SERVER["QUERY_STRING"]:
        require __DIR__ . '/views/home.php';
        break;
    default:
        http_response_code(404);
        require __DIR__ . '/views/error.php';
        break;
}
