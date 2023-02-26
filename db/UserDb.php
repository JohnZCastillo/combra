<?php

namespace db;

use Exception;
use db\Database;
use model\user\User;

require_once 'autoload.php';

class UserDb
{

    //register user in databse
    public static function addUser(User $user)
    {

        $name = $user->getFullname();
        $email = $user->getEmail();
        $mobile = $user->getMobile();
        $password = $user->getPassword();
        $address = $user->getAddress();
        $created = date('Y-m-d');
        $role = 2;

        //check if username is available
        if (self::isEmailTaken($email)) {
            throw new Exception('Email is in used');
        }

        $connection = Database::open();

        $stmt = $connection->prepare("INSERT INTO user(fullname,email,password,address,mobile,role,created) values(?,?,?,?,?,?,?)");

        $stmt->bind_param(
            "ssssdds",
            $name,
            $email,
            $password,
            $address,
            $mobile,
            $role,
            $created
        );

        $stmt->execute();

        $error = mysqli_error($connection);

        Database::close($connection);

        return $error;
    }

    public static function getUserByEmail($email)
    {

        // open database connection
        $conn = Database::open();

        $stmt = $conn->prepare("SELECT * FROM USER WHERE user.email = ?");

        // set the ?'s mark data to parameter's data
        $stmt->bind_param("s", $email);

        // execute prepared statement
        $stmt->execute();

        //get result
        $result = $stmt->get_result();

        // store result in array
        $data = $result->fetch_assoc();

        // throw an exception data is null that means username is not present in db
        if ($data == null) {
            Database::close($conn);
            throw new Exception('Username not found | Invalid Connection');
        }

        Database::close($conn);

        //crete user base on collected data | more like format 
        $user = new User($data['fullname'], $data['email'], $data['password']);

        $user->setFullname($data['fullname']);
        $user->setEmail($data['email']);
        $user->setMobile($data['mobile']);
        $user->setAddress($data['address']);
        $user->setPassword($data['password']);
        $user->setStatus($data['status']);
        $user->setCreated($data['created']);
        $user->setRole($data['role']);

        return $user;
    }

    public static function getUserById($id)
    {

        // open database connection
        $conn = Database::open();

        $stmt = $conn->prepare("SELECT * FROM user where id = ?");


        // set the ?'s mark data to parameter's data
        $stmt->bind_param("s", $id);

        // execute prepared statement
        $stmt->execute();

        //get result
        $result = $stmt->get_result();

        // store result in array
        $data = $result->fetch_assoc();

        // throw an exception data is null that means username is not present in db
        if ($data == null) {
            Database::close($conn);
            throw new Exception('Username not found | Invalid Connection');
        }

        Database::close($conn);

        //crete user base on collected data | more like format 
        $user = new User($data['fullname'], $data['email'], $data['password']);


        $user->setFullname($data['fullname']);
        $user->setEmail($data['email']);
        $user->setMobile($data['mobile']);
        $user->setAddress($data['address']);
        $user->setPassword($data['password']);
        $user->setStatus($data['status']);
        $user->setCreated($data['created']);
        $user->setRole($data['role']);

        return $user;
    }

    public static function getAllUser()
    {

        // open database connection
        $conn = Database::open();

        $stmt = $conn->prepare("SELECT * FROM user");

        // execute prepared statement
        $stmt->execute();

        //get result
        $result = $stmt->get_result();

        $users = array();

        while ($data = $result->fetch_assoc()) {
            //crete user base on collected data | more like format 
            $user = new User($data['fullname'], $data['email'], $data['password']);

            $user->setFullname($data['fullname']);
            $user->setEmail($data['email']);
            $user->setMobile($data['mobile']);
            $user->setAddress($data['address']);
            $user->setPassword($data['password']);
            $user->setStatus($data['status']);
            $user->setCreated($data['created']);
            $user->setRole($data['role']);

            array_push($users, $user);
        }

        Database::close($conn);

        // throw an exception data is null that means username is not present in db
        if ($users == null) {
            throw new Exception('Username not found | Invalid Connection');
        }

        return $users;
    }

    public static function isUsernameTaken($email)
    {
        try {
            self::getUserByEmail($email);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    //check if email is taken    
    public static function isEmailTaken($email)
    {
        try {

            // open database connecti/on
            $conn = Database::open();

            $stmt = $conn->prepare("SELECT * FROM user WHERE user.email = ?");

            // set the ?'s mark data to parameter's data
            $stmt->bind_param("s", $email);

            // execute prepared statement
            $stmt->execute();

            //get result
            $result = $stmt->get_result();

            // store result in array
            $data = $result->fetch_assoc();

            // throw an exception data is null that means email is not present in db
            if ($data == null) {
                Database::close($conn);
                throw new Exception('Username not found | Invalid Connection');
            }

            Database::close($conn);
        } catch (Exception $ex) {
            return false;
        }

        return true;
    }
}
