<?php

    session_start();
    if(!$_SESSION['login'] || !$_SESSION['password']) {
        header("Location: login.php");
        die();
    }

    if($_POST['unlogin']) {
        session_destroy();
        header("Location: login.php");
    }
    $color = $_COOKIE['color'];

?>

<body style="font-size: 40px; background-color: <?=$color?>">
    <p>Сайт только для авторизованных пользователей</p>
    <? echo "Привет, " . $_SESSION['login'] . "<br>"; ?>
    <img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fi.pinimg.com%2Foriginals%2Faa%2F5c%2F6f%2Faa5c6f1614ac62fd6b3f17c9e47664ac.jpg&f=1&nofb=1" alt="Чебоксары" width="600" style="display: block">

    <form method="post" style="margin: 40px; font-size: 40px">
        <input style="font-size: 30px" type="submit" name="unlogin" value="НА страницу авторизации">
    </form>

</body>
