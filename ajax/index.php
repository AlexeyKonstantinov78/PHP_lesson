<?php
session_start();
require_once 'db/db.php';

$products = $connect -> query("SELECT * FROM products")
                    ->fetchAll(PDO::FETCH_ASSOC);

$cats = $connect -> query("SELECT * FROM cats")
    ->fetchAll(PDO::FETCH_ASSOC);

$colors = $connect -> query("SELECT * FROM colors")
    ->fetchAll(PDO::FETCH_ASSOC);

$weights = $connect -> query("SELECT * FROM weights")
    ->fetchAll(PDO::FETCH_ASSOC);

//echo "<pre>";
//var_dump($products);
//echo "<pre>";
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ajax</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">

</head>
<body>
    <div class="container">

        <div class="select">
            <select name="cat" id="cat">
                <option value="all">Все категории</option>
                <?php foreach ($cats as $cat) {?>
                <option value="<?=$cat['cat']?>" <? if ($_SESSION['cat'] == $cat['cat']) {echo 'selected';}?>><?=$cat['cat']?></option>
                <?php }?>
            </select>
            <select name="color" id="color">
                <option value="all">Все цвета</option>
                <?php foreach ($colors as $color) {?>
                    <option value="<?=$color['color']?>" <? if ($_SESSION['color'] == $color['color']) {echo 'selected';}?>><?=$color['color']?></option>
                <?php }?>
            </select>
            <select name="weight" id="weight">
                <option value="all">Любой вес</option>
                <?php foreach ($weights as $weight) {?>
                    <option value="<?=$weight['weight']?>" <? if ($_SESSION['weight'] == $weight['weight']) {echo 'selected';}?>><?=$weight['weight']?></option>
                <?php }?>
            </select>
        </div>

        <div class="row cards-block">
           <?php
           require_once 'actions/query.php'
           ?>
        </div>
    </div>
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/ajax.js"></script>
</body>
</html>
