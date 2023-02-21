<?php
//закрываем доступ с помощью этого скрипта не зарегистрированным пользователем

$login = $_COOKIE['login'];
$token = $_COOKIE['token'];

include_once 'connection/connectMySql.php';

$sql = "SELECT * FROM `users` WHERE `login` = '$login'";

    if($result = $mysql->query($sql)) {

    foreach($result as $row) {

    $userLogin = $row["login"];
    $userToken = $row["token"];

    }

    //делаем проверку с хешем
    if (!password_verify($userToken, $token)) {
        if($userLogin != 'admin99' || $token != $userToken) {
            exit('вы не зарегистрированы');
        }
        else if(empty($login) || empty($token)) {
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Регистрация</title>
</head>
<body class="bg-dark">
    <main>
        <h1 class="text-white">yes</h1>
    </main>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>