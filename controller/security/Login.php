<?php

namespace controller\security;

require_once 'autoload.php';

use db\UserDb;
use Exception;

session_start();

$email = $_POST['email'];
$password = $_POST['password'];

if (isset($email, $password)) {

    try {

        $user = UserDb::getUserByEmail($email);

        if ($user->getPassword() ===  $password && $user->getEmail() === $email) {
            unset($_SESSION['loginError']);

            $role = $user->getRole();

            switch ($role) {
                case 1:
                    header('Location: ./admin');
                    break;
                case 2:
                    header('Location: ./home');
                    break;
            }
        } else {
            throw new Exception("");
        }
    } catch (Exception $ex) {
        $_SESSION['loginError'] = "Username/Password is Incorrect!";
        header('Location: ./login');
    }
}
