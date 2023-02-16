<?php

$login = $_POST['login'];
$password = $_POST['password'];


include_once '../connection/connectMySql.php';



if(strlen($login) <= 5){
    echo "<h3>Введите логин!</h3>" . header("refresh:3;url=../authorization.php");
}
else if(strlen($password) < 8) {
    echo "<h3>Введите пароль!</h3>". var_dump($password);
}
else{
$sql = "SELECT * FROM `users` WHERE `login` = '$login'";
if($result = $mysql->query($sql)){
    foreach($result as $row) {
    $userlogin = $row["login"];
    $userpassword = $row["password"]; 
    $usertoken = $row["token"];
    }
    if(empty($usertoken)) {
        echo "<h3>Вы не зарегистрированы</h3>".header("refresh:3;url=../authorization.php");
    }
    else if($login = $userlogin) {
        if(password_verify($password, $userpassword)) {

            $mysql->close();

            setcookie('user', $login, time() + (10 * 365 * 24 * 60 * 60), "/");

            header("Refresh:0; url=../crud.php");
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