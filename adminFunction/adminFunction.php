<?php

include_once 'connection/connectMySql.php';

$login = $_POST['login'];
$password = $_POST['password'];

//получаем айди для работы с полем по айди
$get_id = $_GET['id'];

//read users
$result = $mysql->query("SELECT * FROM `users` WHERE `flag` = 0");

//add users
if(isset($_POST['add'])) {
    if(preg_match('/[А-Я а-яЁё.,]/u', $login)) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
      }
      else if(preg_match('/[А-Я а-яЁё]/u', $password)) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
      }
      else{
         //проверка на пустоту и введенных данных
          if(strlen($login) <= 5 || strlen($login) > 15) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
          }
          else if(strlen($password) < 8 || strlen($password) > 20) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
          }
          else if($login == $password) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
          }
          else {
                //генирация токена
                $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $token = substr(str_shuffle($permitted_chars), 0, 10);

                //хеширование пароля
                $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12,]);

                $query = $mysql->query("INSERT INTO `users` (`login`,`password`,`token`,`flag`) VALUES ('$login','$password','$token','0')");

                if($query) {
                    header("Location: " . $_SERVER['HTTP_REFERER']);
                }
          }
      }
    
}

//update users
if(isset($_POST['edit'])) {


    if(preg_match('/[А-Я а-яЁё.,]/u', $login)) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
      }
      else if(preg_match('/[А-Я а-яЁё]/u', $password)) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
      }
      else{
         //проверка на пустоту и введенных данных
          if(strlen($login) <= 5 || strlen($login) > 15) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
          }
          else if(strlen($password) < 8 || strlen($password) > 20) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
          }
          else if($login == $password) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
          }
          else {
    
            $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12,]);
            $query = $mysql->query("UPDATE `users` SET `login` = '$login', `password` = '$password' WHERE `id` = '$get_id'");

            if($query) {
                header("Location: " . $_SERVER['HTTP_REFERER']);
            }
        }
    }
}

//delete users
if(isset($_POST['delete'])) {
    $query = $mysql->query("UPDATE `users` SET `flag` = '1' WHERE `id` = '$get_id'");

    if($query) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
}

