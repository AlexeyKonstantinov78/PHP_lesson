<?php

    $connection = new PDO('mysql:host=localhost:3305; dbname=practice_db; charset=utf8', 'root', 'root');
    $msg = '';
    $base_url = 'http://academyphp:81/cookies/activation.php?code=';

    if($_POST['login'] && $_POST['password'] && $_POST['email']) {
        $login = $_POST['login'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $activation = md5($email.time());
        $connection->query("insert into login (login, password, email, activation) VALUE ('$login', '$password', '$email', '$activation')");
        //header('Location: registration.php');

        include 'send_Mail.php';

        $to = $email;
        $subject = 'Подтверждение электронной почты';
        $body = 'Здравствуйте! <br/> <br/> Мы должны убедиться в том, что вы человек. Пожалуйста, 
            подтвердите адрес вашей электронной почты, и можете начать использовать ваш аккаунт на сайте. 
            <br/> <br/> 
            <a href="'. $base_url . $activation.'">'.$base_url.$activation.'</a>';

//        $headers  = "Content-type: text/html; charset=windows-1251 \r\n";
//        $headers .= "From: От кого письмо <info.alekseykonstantinov.ru>\r\n";
//        $headers .= "Reply-To: info.alekseykonstantinov.ru\r\n";

//        if (mail($to, $subject, $body, $headers)) {
//            $msg= "Регистрация выполнена успешно, пожалуйста, проверьте электронную почту.";
//        }
        Send_Mail($to, $subject, $body);
        $msg= "Регистрация прошла успешно! Пройдите активацию через email.";
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
    <p>Регистрация</p>
    <input type="text" name="login" required placeholder="Логин"> <br>
    <input type="password" name="password" required placeholder="Пароль"> <br>
    <input type="email" name="email" required placeholder="Email"> <br>
    <input type="submit">
    <span><?php echo $msg; ?></span>
</form>


