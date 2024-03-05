<?php
//Luis Duarte, 10/5/23, IT 202 005, Unit 5 assigment and lvd@njit.edu.
function getDB(){
    $njit_dsn = 'mysql:host=sql.njit.edu;port=3306;dbname=lvd';
    $njit_username = 'lvd';
    $njit_password = '230/Westminster';

    $dsn = $njit_dsn;
    $username = $njit_username;
    $password = $njit_password;

    try{
        $db = new PDO($dsn, $username, $password);
    }catch(PDOException $exception){
        $error_message = $exception->getMessage();
        include("database_error.php");
        exit();
    }
return $db;

  }