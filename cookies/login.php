<?php

    ini_set('session.gc_maxlifetime', 3800); // нужно писать до открытия сеанса случаях выдает ошибку меняется на стороне хостинга
    session_start(); // как и везде не ставить перед ним ни чего
    // ini_set('session.gc_maxlifetime', 3800); // в некоторых случаях выдает ошибку меняется на стороне хостинга
    $connection = new PDO('mysql:host=localhost:3305; dbname=practice_db; charset=utf8', 'root', 'root');
    $login = $connection->query("SELECT * FROM login");

    if($_POST['login']) {
        foreach ($login as $log) {
            if($_POST['login'] == $log['login'] && $_POST['password'] == $log['password']) {
                $_SESSION['login'] = $_POST['login'];
                $_SESSION['password'] = $_POST['password'];
                header("Location: content.php");
            }
        }

        echo "Неверный логин или пароль";
    }
?>

<style>
    body {
        margin: 200px 300px;
    }
    input, p {
        font-size: 30px;
        margin: 10px;
    }
</style>

<form method="post">
    <p>Авторизуйтесь</p>
    <input type="text" name="login" required placeholder="Логин"> <br>
    <input type="password" name="password" required placeholder="Пароль"> <br>
    <input type="submit">
</form>
