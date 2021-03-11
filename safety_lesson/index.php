<?php
    $connection = new PDO('mysql:host=localhost:3305; dbname=forum; charset=utf8', 'root', 'root');
    $data = $connection -> query('select * from comments where moderation="ok" ORDER BY date DESC');

    if ($_POST['text']) {
        //$username = strip_tags($_POST['username']);// strip_tags вырезает теги из сообщения защита XSS
        $username = htmlspecialchars($_POST['username']);// превращает все в текст защита XSS
        $text = htmlspecialchars($_POST['text']);
        //$text = strip_tags($_POST['text']);
        $time = date("Y-m-d H:i:s");
        //$connection -> query("INSERT INTO comments (username, comment, date) VALUES ('$username', '$text', '$time')"); //для защиты от sql инекций нужно подготовить запрос prepare

        //защита от sql инекций
        $save = $connection -> prepare("INSERT INTO comments (username, comment, date) VALUES (:username, :text, '$time')");
        $arr = ['username'=>$username, 'text'=>$text];
        $save->execute($arr);

        header('Location: index.php');
    }
    echo $_POST['text'];
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форум любителей форумов</title>
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
    <h1>Форум любителей форумов</h1>
    <form method="post">
        <input type="text" name="username" placeholder="Ваше имя" required>
        <textarea name="text" required placeholder="Ваше сообщение" style="height: 200px; width: 400px"></textarea>
        <button  type="submit">Отправить</button>
    </form>
    <hr>
    <h1>Сообщение уважаемых пользователей</h1>
    <h3>Все сообщения проходят модерацию</h3>
    <? if ($data) {
        foreach ($data as $dat) {?>
            <p><?=$dat['date'] . " " . $dat['username'] ?> написал: "<?=$dat['comment'] ?>".</p>
            <hr>
        <? }} ?>
</body>
</html>

