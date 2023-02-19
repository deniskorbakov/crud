<?php

include_once 'connection/connectMySql.php';

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

//получаем айди для работы с полем по айди
$get_id = $_GET['id'];

$login = $_COOKIE['login'];
$token = '';

//получаем токен, для дальнейшего взаимодествия с каждым пользователем
$sql = "SELECT * FROM `users` WHERE `login` = '$login'";

    if($result = $mysql->query($sql)) {

        foreach($result as $row) {
            $userToken = $row["token"];
        }

        $token = $userToken;        
    }

//read users
$result = $mysql->query("SELECT * FROM `crudUsers` WHERE `flag` = '0' AND `token` = '$token'");

//add users
if(isset($_POST['add'])) {
    $query = $mysql->query("INSERT INTO `crudUsers` (`created_at`, `updated_at`, `name`, `email`, `password`, `token`, `flag`) VALUES (NOW(),NOW(),'$name','$email','$password','$token','0')");

    if($query) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
}

//update users
if(isset($_POST['edit'])) {
    $query = $mysql->query("UPDATE `crudUsers` SET `updated_at`=NOW(), `name` = '$name', `email` = '$email', `password` = '$password' WHERE `id` = '$get_id' AND `token` = '$token'");

    if($query) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
}

//delete users
if(isset($_POST['delete'])) {
    $query = $mysql->query("UPDATE `crudUsers` SET `flag` = '1' WHERE `id` = '$get_id' AND `token` = '$token'");

    if($query) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
}

