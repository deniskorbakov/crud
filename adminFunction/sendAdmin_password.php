<?php

$oldPassword = $_POST['oldPassword'];
$password = $_POST['password'];

$login = $_COOKIE["login"];

if(preg_match('/[А-Я а-яЁё]/u', $password)) {
    echo "<h3>Пароль - введен не коректно: не должно быть - пробелов, русских символов</h3>" . header("refresh:3;url=../personalAdmin.php");
}
else if(empty($password)) {
    echo "<h3>Пустоя строка нового пароля</h3>" . header("refresh:3;url=../personalAdmin.php");
}
else if(strlen($password) < 8 || strlen($password) > 20) {
    echo "<h3>Короткий пароль, должен быть не менее 8 символов и не больше 20 символов!</h3>" . header("refresh:3;url=../personalAdmin.php");
}
else if($oldPassword == $password) {
    echo "<h3>Новый пароль должен отличаться от старого</h3>" . header("refresh:3;url=../personalAdmin.php");
}
    else {
    include_once '../connection/connectMySql.php';

    $sql = "SELECT * FROM `users` WHERE `login` = '$login'";

    $result = $mysql->query($sql);

    foreach($result as $row) {
        
    $userPassword = $row["password"]; 

    }

    if(password_verify($oldPassword, $userPassword)) {

        $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12,]);

        $mysql->query("UPDATE `users` SET `password` = '$password' WHERE `users`.`login` = '$login'");
        $mysql->close();
        echo header("refresh:0;url=../personalAdmin.php");
    }
    else{
        echo "<h3>Вы ввели не правильный старый пароль</h3>".header("refresh:3;url=../personalAdmin.php");
    }
    }

