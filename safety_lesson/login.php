<?php
    // вход по логину
    ini_set('session.gc_maxlifetime', 3800); // нужно писать до открытия сеанса случаях выдает ошибку меняется на стороне хостинга
    session_start(); // как и везде не ставить перед ним ни чего
    $connection = new PDO('mysql:host=localhost:3305; dbname=forum; charset=utf8', 'root', 'root');
    $login = $connection->query("SELECT * FROM admin");

    if($_SESSION['login'] || $_SESSION['password']) {
        header("Location: admin.php");
    }

    if($_POST['login']) {
        foreach ($login as $log) {
            if($_POST['login'] == $log['login'] && $_POST['password'] == $log['password']) {
                $_SESSION['login'] = $_POST['login'];
                $_SESSION['password'] = $_POST['password'];

                header("Location: admin.php");
            }
        }

        echo "Неверный логин или пароль";
    }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход в адинку</title>
</head>
<style>
    body{
        margin: 50px;
        font-family: Arial;
    }
    input, textarea, button{
        display: flex;
        margin: 15px;
        font-size: 22px;
    }
</style>
<body>
    <h1>Вход в адинку</h1>
    <form method="post">
        <input type="text" name="login" placeholder="login" required>
        <input type="password" name="password" placeholder="Пароль" required>
        <button  type="submit">Отправить</button>
    </form>

</body>
</html>