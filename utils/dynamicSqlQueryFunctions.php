<?php

function objectToInsertSqlQuery($object, $tableName) :string{
    $object=(array) $object;
    $values="";
    $data="";
    foreach ($object as $key=>$value){
        $values=$values.$key;
        $values=$values.", ";
        (!is_numeric($value) && !is_bool($value))? $data=$data."'":"";
        $data=$data.$value;
        (!is_numeric($value) && !is_bool($value))? $data=$data."'":"";
        $data=$data.", ";
    }
    $values=substr($values, 0,strlen($values)-2);
    $data=substr($data, 0,strlen($data)-2);

    $sql= "insert into $tableName ($values) values ($data)";
    return $sql;
}

function objectToUpdateSqlQuery($object, $tableName, $condition="") :string{
    $object=(array) $object;
    $values="";
    foreach ($object as $key=>$value){
        $values=$values.$key;
        $values=$values."=";
        (!is_numeric($value) && !is_bool($value))? $values=$values."'":"";
        $values=$values.$value;
        (!is_numeric($value) && !is_bool($value))? $values=$values."'":"";
        $values=$values.", ";
    }
    $values=substr($values, 0,strlen($values)-2);


    $sql= "update $tableName  set $values $condition";
    return $sql;
}