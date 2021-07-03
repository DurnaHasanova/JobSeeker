<?php


class  User{
    public  string $email;
    public  string $name;
    public string $userType;
    public  string $password;


    function __construct($email, $name, $userType, $password) {
        $this->email=$email;
        $this->password=$password;
        $this->userType=$userType;
        $this->name=$name;

    }
}
