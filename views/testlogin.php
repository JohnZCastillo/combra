<?php ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boostrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Login</title>
</head>

<style>
    .rounded {
        border-radius: 20px !important;
    }

    .shadow {
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px !important;
    }

    .grad {
        background-image: linear-gradient(#2388d9, #7db7e0);
    }

    .bg-main {
        background-image: url("../resources/images/background.png");
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }

    .img-small {
        width: 50px;
        height: auto;
    }
</style>

<body>
    <div class="container-fluid bg-main" style="min-height: 100vh;">

        <nav class="d-flex align-items-center p-3 sticky-top">
            <img src="../resources/images/store.png" class="img-small">
            <p class="m-0">COMBRA ONLINE GROCERY STORE</p>
        </nav>

        <div class="row p-3 align-items-center justify-content-center">
            <div class="col">
                <img src="../resources/images/login.png" class="img-fluid d-block mx-auto">
            </div>
            <div class="col col">
                <div style="max-width: 350px;" class="mx-auto grad  p-3 rounded">
                    <h2 class="text-light text-center">Welcome to Combra Grocery Store</h2>
                    <form action="" class="bg-light form p-3 rounded shadow">
                        <h2 class="text-primary">Login</h2>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <a href="#" class="text-dark my-2">Forgot Password?</a>
                        <button type="submit" class="d-block mx-auto btn btn-primary w-75 rounded">LOGIN</button>
                        <p class="text-center mt-2">Don't have an account? <a href="#">SIGN UP</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>