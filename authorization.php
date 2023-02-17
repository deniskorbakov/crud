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
                    <a href="index.php" class="btn btn-danger p-2 mt-4 ml-4">Перейти на регистрацию</a>
                </form>
            </div>
        </div>
    </main>
</body>
</html>