<?php

include_once 'connection/connectMySql.php';

$login = $_POST['login'];
$password = $_POST['password'];

//получаем айди для работы с полем по айди
$get_id = $_GET['id'];

//хеширование пароля
$password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12,]);

//read users
$result = $mysql->query("SELECT * FROM `users` WHERE `flag` = 0");

//add users
if(isset($_POST['add'])) {
    //генирация токена
    $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $token = substr(str_shuffle($permitted_chars), 0, 10);

    $query = $mysql->query("INSERT INTO `users` (`login`,`password`,`token`,`flag`) VALUES ('$login','$password','$token','0')");

    if($query) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
}

//update users
if(isset($_POST['edit'])) {
    $query = $mysql->query("UPDATE `users` SET `login` = '$login', `password` = '$password' WHERE `id` = '$get_id'");

    if($query) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
}

//delete users
if(isset($_POST['delete'])) {
    $query = $mysql->query("UPDATE `users` SET `flag` = '1' WHERE `id` = '$get_id'");

    if($query) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
}

