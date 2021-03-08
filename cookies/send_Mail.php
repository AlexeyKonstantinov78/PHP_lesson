<?php
function Send_Mail($to,$subject,$body)
{
    require 'phpmailer/class.phpmailer.php';
    require 'phpmailer/class.smtp.php';
    $from  = "info@alekseykonstantinov.ru";
    $mail  = new PHPMailer();
    $mail->CharSet = 'utf-8';
    $mail->IsSMTP();            // используем протокол SMTP
    $mail->IsHTML(true);
    $mail->SMTPAuth   = true;                  // разрешить SMTP аутентификацию
    $mail->Host       = "smtp.timeweb.ru"; // SMTP хост
    $mail->SMTPSecure = 'ssl';
    $mail->Port       =  465;                    // устанавливаем SMTP порт
    $mail->Username   = "info@alekseykonstantinov.ru";  //имя пользователя SMTP
    $mail->Password   = "";  // SMTP пароль
    $mail->SetFrom($from, 'From Name');

    $mail->AddReplyTo($from,'From Name');

    $mail->Subject    = $subject;
    $mail->MsgHTML($body);
    $address = $to;
    $mail->AddAddress($address, $to);
    if (!$mail->Send()) {
        echo 'Error';
    } else {
        header('Location: login.php');
    }

}
?>