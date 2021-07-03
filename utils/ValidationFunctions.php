<?php
require 'configs.php';
require './model/Result.php';
require  './constants/ReturnCode.php';


function isEmailExist($email,) :Result{
    $sql="select * from user where email='$email'";
    global  $connection;
    $result= mysqli_query($connection, $sql);
    if(mysqli_num_rows($result)>0){

        return new Result(ReturnCode::EMAIL_IS_EXIST);
    }
    return  new Result(ReturnCode::SUCCESS);;
}

function validatePassword($password) :Result{
    $passValidationRegex='/[!@#$%*a-zA-Z0-9]{8,}/';
    if(!preg_match($passValidationRegex, $password)){
        return new Result(ReturnCode::PASSWORD_DOES_NOT_MATCH);
    }
    return  new Result(ReturnCode::SUCCESS);
}