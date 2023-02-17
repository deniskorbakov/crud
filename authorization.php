<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Авторизация</title>
</head>
<body class="bg-dark">
    <main>
        <div class="container mt-5">
            <h1 class="text-center text-white">Авторизация</h1>

            <div class="container mt-4">
                <form class="mt-5" action="backend/authorizationBack.php" method="post">
                    <input class="form-control p-2" name="login" type="text" placeholder="Введите логин">
                    <input class="form-control p-2 mt-4" name="password" type="password" placeholder="Введите пароль">
                    <button class="btn btn-success p-2 mt-4" type="submit">Авторизироваться</button>
                    <a href="index.php" class="btn btn-danger p-2 mt-4 ms-2">Перейти на регистрацию</a>
                </form>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>