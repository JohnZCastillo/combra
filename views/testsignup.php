<?php
session_start();
?>
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
        background-image: url("./resources/images/background.png");
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
</style>

<body>
    <div class="container-fluid bg-main">

        <div class="row p-3 align-items-center justify-content-center">
            <div class="col-sm">
                <h1 class="text-center text-primary">Create Your Account!</h1>
                <img src="./resources/images/signup.png" class="img-fluid d-block mx-auto">
            </div>
            <div class="col-sm">
                <div class="mx-auto grad p-3 rounded">
                    <form method="POST" action="./register" class="bg-light form p-3 rounded shadow">
                        <h2 class="text-primary text-center">SIGN UP</h2>
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="contact">Contact Number</label>
                            <input type="te" name="mobile" id="mobile" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" name="address" id="address" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <button type="submit" class="d-block mx-auto btn btn-primary w-75 rounded">SIGN UP</button>
                        <p class="text-center mt-2">Already have an account? <a href="./login">LOG IN</a></p>
                        <p class="text-danger text-center">
                            <?php
                            if (isset($_SESSION['signupError'])) {
                                echo $_SESSION['signupError'];
                            }
                            ?>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>