<?php

include_once 'connection/connectMySql.php';

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

if(isset($_POST['add'])) {
    $query = $mysql->query("INSERT INTO `crudUsers` (`created_at`, `updated_at`, `name`, `email`, `password`) VALUES (NOW(),NOW(),'$name','$email','$password')");

    if($query) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
}

$result = $mysql->query("SELECT * FROM `crudUsers`");

