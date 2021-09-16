<?php

$dsn = 'mysql:host=db;dbname=webapp;';
$user = 'root';
$password = 'root';

try{
    $db = new PDO($dsn, $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch (PDOException $e){
    print('Error:'.$e->getMessage());
    exit();
}

