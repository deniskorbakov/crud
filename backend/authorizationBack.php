<?php

$login = $_POST['login'];
$password = $_POST['password'];

include_once '../connection/connectMySql.php';

if(strlen($login) <= 5){
    echo "<h3>Введите логин!</h3>" . header("refresh:3;url=../authorization.php");
}
else if(strlen($password) < 8) {
    echo "<h3>Введите пароль!</h3>" . header("refresh:3;url=../authorization.php");
}
else{

$sql = "SELECT * FROM `users` WHERE `login` = '$login'";
if($result = $mysql->query($sql)){
    foreach($result as $row) {
    $userlogin = $row["login"];
    $userPassword = $row["password"]; 
    $userToken = $row["token"];
    }
    if(empty($userToken)) {
        echo "<h3>Вы не зарегистрированы</h3>".header("refresh:3;url=../authorization.php");
    }
    else if($login = $userlogin) {
        if(password_verify($password, $userPassword)) {
            
            //хешируем токен для безопастности
            $token = password_hash($userToken, PASSWORD_BCRYPT, ['cost' => 12,]);

            setcookie('login', $login, time() + (10 * 365 * 24 * 60 * 60), "/");
            setcookie('token', $token, time() + (10 * 365 * 24 * 60 * 60), "/");

            //переадресация на админку
            if($login == 'admin99' && password_verify($password, $userPassword)) {
                header("Refresh:0; url=../adminPanel.php");
            }
            else {
                header("Refresh:0; url=../crud.php");
            }
            
            
        }
        else {
            echo "<h3>Не правильный пароль</h3>".header("refresh:3;url=../authorization.php");
        }
    }
    else {
        echo "<h3>Пользователей не найден!</h3>".header("refresh:3;url=../authorization.php");
    }

}
}

?>