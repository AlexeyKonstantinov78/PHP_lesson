<?php
$connection = new PDO('mysql:host=localhost:3305; dbname=practice_db; charset=utf8', 'root', 'root');

$msg='';
if(!empty($_GET['code']) && isset($_GET['code']))
{
    $code= $_GET['code'];
    $c=$connection->query($connection,"SELECT id FROM login WHERE activation='$code'");
    if(mysqli_num_rows($c) > 0)
    {
        $count=mysqli_query($connection,"SELECT uid FROM users WHERE activation='$code' and status='0'");

        if(mysqli_num_rows($count) == 1)
        {
            mysqli_query($connection,"UPDATE users SET status='1' WHERE activation='$code'");
            $msg="Ваш аккаунт активирован";
        }
        else
        {
            $msg ="Ваш аккаунт уже активирован, нет необходимости активировать его снова.";
        }
    }
    else
    {
        $msg ="Неверный код активации.";
    }
}
?>
    //HTML часть
<?php echo $msg; ?>