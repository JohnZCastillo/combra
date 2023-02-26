<?php

namespace views\helper;

require_once 'autoload.php';

use model\product\Product;

class ProductDisplayer
{

    public static function displayProduct(Product $product)
    {
        $name = $product->getName();
        $imagePath = $product->getImagePath();
        $description = $product->getDescription();
        $price = $product->getPrice();

        echo "
        <div class='card' style='width: 300px;'>
        <img class='card-img-top' src='$imagePath'>
        <div class='card-body product-title'>
            <h5 class='cart-title'>$name</h5>
            <i class='fa-regular fa-heart'></i>
            <i class='fa-solid fa-cart-plus'></i>
        </div>
        <div class='card-body'>
            <p class='card-text'>$description</p>
        </div>
        <div class='card-body d-flex align-items-center'>
            <i class='fa-solid fa-star text-warning'></i>
            <i class='fa-solid fa-star text-warning'></i>
            <i class='fa-solid fa-star text-warning'></i>
        </div>
        <div class='card-body d-flex align-items-center'>
            <i class='fa-solid fa-peso-sign'></i>
            <p class='m-0'>$price</p>
        </div>
    </div>";
    }
}
