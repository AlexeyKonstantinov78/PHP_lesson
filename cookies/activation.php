<?php
$connection = new PDO('mysql:host=localhost:3305; dbname=practice_db; charset=utf8', 'root', 'root');
$msg='';

if(!empty($_GET['code']) && isset($_GET['code']))
{
    $code = ($_GET['code']);
    $c = $connection->query("SELECT id FROM login WHERE activation='$code'");
    $c = $c->fetch();
    echo $code . "<br>";
    echo $c;

    if($c > 0)
    {
        $count=$connection ->query("SELECT id FROM login WHERE activation='$code' and status='0'");
        $count=$count->fetch();
        foreach ($count as $con){
            echo $con;
        }
        echo $count;

        if($count == 1)
        {
            $connection->query("UPDATE login SET status='1' WHERE activation='$code'");
            $msg="Ваш аккаунт активирован";
        }
        else
        {
            $msg ="Ваш аккаунт уже активирован";
        }

    }
    else
    {
        $msg ="Неверный код активации";
    }

}
?>
    //HTML часть
<?php echo $msg; ?>