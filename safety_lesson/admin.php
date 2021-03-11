<?php
    // проверка на авторизацию
    session_start();
    if(!$_SESSION['login'] || !$_SESSION['password']) {
        header("Location: login.php");
        die();
    }

    // раз авторизоватся
    if($_POST['unlogin']) {
        session_destroy();
        header("Location: login.php");
    }

    if (count($_POST) > 0) {
        header("Location: admin.php");
    }

    $connection = new PDO('mysql:host=localhost:3305; dbname=forum; charset=utf8', 'root', 'root');
    $data = $connection -> query('select * from comments where moderation="new" ORDER BY date DESC');

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
    <h1>Админка админа</h1>
    <hr>

    <form method="post">
        <? foreach ($data as $comment) {?>
        <select name="<?=$comment['id'] ?>" id="<?=$comment['id'] ?>">
            <option value="ok">OK</option>
            <option value="rejected">Отклонен</option>
        </select>
        <label for="<?=$comment['id'] ?>">
            <?=$comment['username'] . ' оставил комментарий "' . $comment['comment'] . "\"<br/>"?>
        </label>
        <? } ?>
        <button name="">Модерировать</button>
    </form>

    <hr>
    <form method="post" style="margin: 40px; font-size: 40px">
        <input style="font-size: 30px" type="submit" name="unlogin" value="Выйти из админки">
    </form>
</body>
</html>

<?
echo "<pre>";
var_dump($_POST);
echo "</pre>";

foreach ($_POST as $num=>$checked) {
    if ($checked == 'ok') {
        $connection->query("UPDATE comments set moderation='ok' where id=$num");
    }else {
        if ($checked == 'rejected') {
            $connection->query("UPDATE comments set moderation='rejected' where id=$num");
        }
    }
}