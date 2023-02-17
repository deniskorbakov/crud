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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Личный кабинет</title>
</head>
<body class="bg-dark">
    <main>
        <div class="container mt-5">
            <h1 class="text-center text-white">Кабинет пользователя</h1>

            <h3 class="mt-5 text-white">Имя пользователя: <?php echo $_COOKIE["login"];?></h3>

            
            <a href="#" class="nav-link px-8 link-secondary fw-bolder mt-4" data-bs-toggle="modal" data-bs-target="#exampleModal"><h3 class="text-danger">Сбросить пароль</h3></a>

        <!-- сброс пароля -->
            <div class="mt-2 modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Сброс пароля</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <form action="send_password.php" method="post">
                                <div class="form-group col-md-8 m-2 mx-auto">
                                    <label>Введите старый пароль</label>
                                    <input name="old_password_input" type="password" class="form-control">
                                </div>
            
                                <div class="form-group col-md-8 m-2 mx-auto">
                                    <label>Введите новый пароль</label>
                                    <input name="password1_input" type="password" class="form-control">
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Выйти</button>
                                    <button type="submit" class="btn btn-success">Отправить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <a href="#" class="nav-link px-8 link-secondary fw-bolder mt-2" data-bs-toggle="modal" data-bs-target="#exampleModal1"><h3 class="text-danger">Изменить логин</h3></a>

            <!-- изменить логин -->
            <div class="mt-2 modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel1">Сброс пароля</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <form action="send_password.php" method="post">

                                <div class="form-group col-md-8 m-2 mx-auto">
                                    <label>Введите новый логин</label>
                                    <input name="password2_input" type="password" class="form-control">
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Выйти</button>
                                    <button type="submit" class="btn btn-success">Отправить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <form action="backend/exit.php" method="POST">
                    <input type="submit" name="appetizer_button" value="Выйти" class="mt-5 btn btn-danger">
            </form>
        </div>
    </main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>