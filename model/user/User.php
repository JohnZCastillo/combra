<?php

namespace model\user;


class User
{

    private $id;
    private $fullname;
    private $email;
    private $mobile;
    private $address;
    private $password;
    private $status;
    private $role;
    private $created;

    public function __construct($fullname, $email, $password)
    {
        $this->fullname = $fullname;
        $this->email = $email;
        $this->password = $password;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFullname()
    {
        return $this->fullname;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getMobile()
    {
        return $this->mobile;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setFullname($fullname): void
    {
        $this->fullname = $fullname;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function setMobile($mobile): void
    {
        $this->mobile = $mobile;
    }

    public function setAddress($address): void
    {
        $this->address = $address;
    }


    public function setPassword($password): void
    {
        $this->password = $password;
    }

    public function setStatus($status): void
    {
        $this->status = $status;
    }

    public function setCreated($created): void
    {
        $this->created = $created;
    }

    public function setRole($role): void
    {
        $this->role = $role;
    }
}
