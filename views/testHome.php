<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Fontawesom -->
    <script src="https://kit.fontawesome.com/f0632fdfe1.js" crossorigin="anonymous"></script>

    <!-- Bootsrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Home</title>
</head>


<body>

    <style>
        .nav-link {
            padding: 10px 30px !important;
            background-color: #138afe;
            border-radius: 20px;
            color: white !important;
        }

        .bg-nav {
            background-color: #4aa4e4;
        }

        .search {
            border-radius: 30px !important;
            background-color: white !important;
            padding: 5px 10px;
            min-width: 300px;
        }

        .search-input {
            outline: none !important;
            border: none !important;
            flex-basis: 90%;
        }

        .product-title {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .card-body {
            padding-block: 3px !important;
        }

        .products {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
    </style>
    <nav class="navbar navbar-expand-lg navbar-light bg-nav">
        <a class="navbar-brand" href="#">
            <img src="./resources/images/store.png" width="30" height="30" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto" style="gap:10px">
                <li class="nav-item">
                    <a class="nav-link" href="./home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./category">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Shop</a>
                </li>
            </ul>
            <div class="d-flex align-items-center justify-content-center" style="gap:10px">
                <form method="GET" action="./home" class="search d-flex align-items-center">
                    <input class="search-input" type="search" placeholder="search an item">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </form>
                <i class="fa-solid fa-lg fa-cart-shopping" id="cart-icon"></i>
                <i class="fa-solid fa-lg fa-user"></i>
            </div>
        </div>
    </nav>

    <div class="container-fluid p-3 products">

        <?php

        use db\ProductDb;
        use views\helper\ProductDisplayer;

        try {
            foreach (ProductDb::getAllProducts() as $product) {
                ProductDisplayer::displayProduct($product);
            }
        } catch (Exception $e) {
            echo "<p class='text-danger text-center'>No Product(s) Found</p>";
        }


        ?>
    </div>

    <!-- Bootsrap -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script>
        const cart = document.querySelector("#cart-icon");
        cart.addEventListener('click', (event) => {
            window.location.replace("./cart");
        });
    </script>
</body>

</html>