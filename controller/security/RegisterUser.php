<?php

namespace controller\security;

require_once 'autoload.php';

use db\UserDb;
use Exception;
use model\user\Role;
use model\user\User;

session_start();

try {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $address = $_POST['address'];

    $user = new User($name, $email, $password);
    $user->setMobile($mobile);
    $user->setAddress($address);

    UserDb::addUser($user);
} catch (Exception $e) {
    $_SESSION['signupError'] = $e->getMessage();
    header('Location: ./signup');
}
