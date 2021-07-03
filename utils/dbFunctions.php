<?php


function createuser(User $user){
        $pass=$user->password;
        $user->password=md5($pass);
     $sql= objectToInsertSqlQuery($user, 'user');
     global $connection;
     $result=mysqli_query($connection, $sql);
     print_r($result);

}