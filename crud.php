<?php
//закрываем доступ с помощью этого скрипта не зарегистрированным пользователем

$login = $_COOKIE['login'];
$token = $_COOKIE['token'];

password_verify($password, $userPassword);

include_once 'connection/connectMySql.php';

$sql = "SELECT * FROM `users` WHERE `login` = '$login'";

    if($result = $mysql->query($sql)) {

    foreach($result as $row) {

    $userLogin = $row["login"];
    $userToken = $row["token"];

    }

    //делаем проверку с хешем
    if (!password_verify($userToken, $token)) {
        if($login != $userLogin || $token != $userToken) {
            exit('вы не зарегистрированы');
        }
        else if(empty($login) || empty($login)) {
            exit('вы не зарегистрированы');
        }
     
    }
}
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link
        rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
        integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I"
        crossorigin="anonymous"
    >
    <title>CRUD</title>
</head>
<body class="bg-dark">
    <main>
        <div class="container mt-5">
            <h1 class="text-left text-white">Crud пользователя: <?php ?></h1>
            <a href="personalAcc.php" class="btn btn-success text-right mt-5">Личный кабинет</a>
        </div>
    </main>
</body>
</html>