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
    if(preg_match('/[А-Я а-яЁё.,]/u', $name)) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
      }
      else if(preg_match('/[А-Я а-яЁё]/u', $password)) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
      }
      else{
         //проверка на пустоту и введенных данных
          if(strlen($name) <= 5 || strlen($name) > 15) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
          }
          else if(strlen($password) < 8 || strlen($password) > 20) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
          }
          else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
          }
          else if($name == $password) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
          }
          else {
            $query = $mysql->query("INSERT INTO `crudUsers` (`created_at`, `updated_at`, `name`, `email`, `password`, `token`, `flag`) VALUES (NOW(),NOW(),'$name','$email','$password','$token','0')");

            if($query) {
                header("Location: " . $_SERVER['HTTP_REFERER']);
            }
          }
        }
}

//update users
if(isset($_POST['edit'])) {
    if(preg_match('/[А-Я а-яЁё.,]/u', $name)) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
      }
      else if(preg_match('/[А-Я а-яЁё]/u', $password)) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
      }
      else{
         //проверка на пустоту и введенных данных
          if(strlen($name) <= 5 || strlen($name) > 15) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
          }
          else if(strlen($password) < 8 || strlen($password) > 20) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
          }
          else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
          }
          else if($name == $password) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
          }
          else {
            $query = $mysql->query("UPDATE `crudUsers` SET `updated_at`=NOW(), `name` = '$name', `email` = '$email', `password` = '$password' WHERE `id` = '$get_id' AND `token` = '$token'");

            if($query) {
                header("Location: " . $_SERVER['HTTP_REFERER']);
            }
        }
      }
}

//delete users
if(isset($_POST['delete'])) {
    $query = $mysql->query("UPDATE `crudUsers` SET `flag` = '1' WHERE `id` = '$get_id' AND `token` = '$token'");

    if($query) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
}

