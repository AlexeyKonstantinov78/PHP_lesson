<?php

    if($_POST['first']) {
        setcookie('first', $_POST['first'], time() + 20); // записываем куки с именем и значением first время существования один час с момента вхождения
        setcookie('second', $_POST['second'], time() + 40);
        header('Location: index.php'); // обязательно указывается до вывода на экран иначе буди ошибка
    }


?>


<form action="" method="post">
    <input type="text" name="first" required>
    <input type="text" name="second" required>
    <button>Отправить</button>
</form>

<?
echo $_COOKIE['first'] . ' ' . $_COOKIE['second'] . "<br>";
var_dump($_COOKIE);