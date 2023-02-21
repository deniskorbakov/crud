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

include_once 'adminFunction/adminFunction.php';
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://kit.fontawesome.com/bd53d87eef.css" crossorigin="anonymous">
    <title>ADMIN PANEL</title>
</head>
<body class="bg-dark">
    <main>
        <div class="container mt-5">
            <h1 class="text-center text-white">Crud пользователя: <?php echo $_COOKIE["login"]; ?></h1>
            <a href="personalAcc.php" class="btn btn-success text-right mt-5">Личный кабинет</a>

            <div class="container mt-5">
                <div class="row">
                    <div class="col-12">
                        <button class="btn btn-success mt-5" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-plus"></i></button>
                        <table class="table table-dark table-striped table-hover mt-2">
                            <thead class="thead-dark">
                                <th>ID</th>
                                <th>LOGIN</th>
                                <th>PASSWORD</th>
                                <th>TOKEN</th>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><?php echo $row['id'];?></td>
                                    <td><?php echo $row['login'];?></td>
                                    <td><?php echo $row['password'];?></td>
                                    <td><?php echo $row['token'];?></td>
                                    <td>
                                        <a href="?id=<?php echo $row['id'];?>" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#edit<?php echo $row['id'];?>"><i class="fa-solid fa-edit"></i></a>
                                        <a href="" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?php echo $row['id'];?>"><i class="fa-solid fa-trash-alt"></i></a>
                                    </td>
                                </tr>

                                <!-- Модальное edit -->
                                <div class="modal fade" id="edit<?php echo $row['id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Изменить запись</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="?id=<?php echo $row['id'];?>" method="post">
                                            <div class="form-group">
                                                <small>Имя</small>
                                                <input type="text" class="form-control" name="login" value="<?php echo $row['name'];?>">
                                            </div>

                                            <div class="form-group">
                                                <small>Пароль</small>
                                                <input type="text" class="form-control" name="password" value="<?php echo $row['password'];?>">
                                            </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Закрыть</button>
                                            <button type="submit" class="btn btn-success" name="edit">Сохранить</button>
                                        </form>
                                    </div>
                                    </div>
                                </div>
                                </div>

                                <!-- Модальное delete -->
                                <div class="modal fade" id="delete<?php echo $row['id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Удалить запись №<?php echo $row['id'];?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                                    </div>
                            
                                    <div class="modal-footer">
                                        <form action="?id=<?php echo $row['id'];?>" method="post">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Закрыть</button>
                                            <button type="submit" class="btn btn-danger" name="delete">Удалить</button>
                                        </form>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Модальное окно -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Добавить запись</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <small>Логин</small>
                                <input type="text" class="form-control" name="login">
                            </div>

                            <div class="form-group">
                                <small>Пароль</small>
                                <input type="text" class="form-control" name="password">
                            </div>
                        
                    </div>
                    <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Закрыть</button>
                            <button type="submit" class="btn btn-success" name="add">Сохранить</button>
                        </form>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </main>
<script src="https://kit.fontawesome.com/bd53d87eef.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>