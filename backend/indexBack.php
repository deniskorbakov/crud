<?php

$login = $_POST['login'];
$password = $_POST['password'];

include_once '../connection/connectMySql.php';

//проверка правильности данных только на латыне
if(preg_match('/[А-Я а-яЁё.,]/u', $login)) {
  echo "<h3>Логин - введен не коректно: не должно быть - пробелов, русских символов, точек, запятых</h3>" . header("refresh:3;url=../index.php");
}
else if(preg_match('/[А-Я а-яЁё]/u', $password)) {
    echo "<h3>Пароль - введен не коректно: не должно быть - пробелов, русских символов</h3>" . header("refresh:3;url=../index.php");
}
else{
   //проверка на пустоту и введенных данных
    if(strlen($login) <= 5 || strlen($login) > 15) {
        echo "<h3>Короткий логин длинна должна быть больше 5 символов и не больше 15 символов!!</h3>" . header("refresh:3;url=../index.php");
    }
    else if(strlen($password) < 8 || strlen($password) > 20) {
        echo "<h3>Короткий пароль, должен быть не менее 8 символов и не больше 20 символов!</h3>".header("Refresh:3; url=../index.php");
    }
    else if($login == $password) {
        echo "<h3>Логин и пароль не должны совпадать</h3>".header("Refresh:3; url=../index.php");
    }
    else {

        //составляем запрос к БД
        $query = "SELECT * FROM `users` WHERE `login` ='$login'";

        //Отправляем запрос в БД
        $result = mysqli_query($mysql, $query);
        
        // подсчитываем сколько получили рядов выборки и записываем в переменную $count
        $count = mysqli_num_rows($result);

        if ($count !=0) {
        echo "<h3>Такой логин уже существет!</h3>".header("Refresh:3; url=../index.php");
        
    }
    else{
        //хешируем пароль
        $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12,]);

        //токен для проверки зарегистрированных пользователей
        $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $token = substr(str_shuffle($permitted_chars), 0, 10);

        $mysql->query("INSERT INTO `users` (`login`,`password`,`token`) VALUES ('$login','$password','$token')");
        $mysql->close();

        header("Refresh:0; url=../authorization.php");
    }

    } 
}


