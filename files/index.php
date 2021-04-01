<?php
$connection = new PDO('mysql:host=localhost:3305; dbname=forum; charset=utf8', 'root', 'root');

// отправка на сервер
if(isset($_POST['submit'])) {
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileType = $_FILES['file']['type'];
    $fileError = $_FILES['file']['error'];
    $fileSize = $_FILES['file']['size'];

    // фун explode('.', $fileName) превращает в массив разделенный по точкам abc.xzc.er
    // фун end обращение к последнему элементу массива
    // strtolower принудительно превращаем все буквы прописные.

    $fileExtension = strtolower(end(explode('.', $fileName)));

    //получение имени файла если несколько точек и одно
    $arr = explode('.', $fileName);
    $count = count($arr);
    // условие проверки на несколько точек в названии
    if ($count > 2) {
        $fileTempName = '';

        for ($i = 0; $i < $count - 1; $i++) {
            if ($i == 0) {
                $fileTempName = $arr[$i];
            } else {
                $fileTempName = $fileTempName . '.' . $arr[$i];
            }
        }
        $fileName = $fileTempName;
    } else {
        $fileName = $arr[0];
    }

    $fileName = preg_replace('/[0-9]/', '', $fileName); // регулярное выражение по замене цифр
    $allowedExtensions = ['jpg', 'jpeg', 'png']; // массив с разрешёнными типами файлов

    // сверка на разрешённый тип
    if (in_array($fileExtension, $allowedExtensions)) {
        // проверка на объем
        if ($fileSize < 300000) {
            //проверка на ошибку
            if ($fileError === 0) {
                $connection->query("INSERT INTO images (imagename, extension) VALUES ('$fileName', '$fileExtension')");
                //получаем id
                $lastID = $connection->query("select MAX(id) from images");
                $lastID = $lastID->fetchAll();
                $lastID = $lastID[0][0];
                $fileNameNew = $lastID . '_' . $fileName . '.' . $fileExtension; // название файла
                $fileDestination = 'uploads/' . $fileNameNew; // путь где будит хранится
                move_uploaded_file($fileTmpName, $fileDestination); // копирует файл на сервер
                header('Location: index.php');
                echo 'Успех';

            } else {
                echo "Что-то пошло не так" . $fileError;
            }
        } else {
            echo "слишком большой размер файла";
        }
    } else {
        echo "неверный тип файла";
    }
}
    // получение загруженных картинок
    $data = $connection->query('select * from images');

    echo  "<div style='display: flex; align-items: flex-end; flex-wrap: wrap'>";
    foreach ($data as $img) {
        // фун удаления по нажатию кнопки
        $delete = "delete".$img['id'];
        $fullFileName = $img['id'] . '_' . $img['imagename'] . '.' . $img['extension'];
        $image = "uploads/" . $fullFileName;

        if (isset($_POST[$delete])) {
            $imageID = $img['id'];
            $connection->query("DELETE FROM images where id = '$imageID'");
            if (file_exists($image)) {
                // удаление самого файла с сервера
                unlink($image);
            }
        }
        //вывод на экран

        // проверка на наличие такого файла
        if (file_exists($image)) {
            echo "<div>";
            echo "<img width='150' height='150' src=$image alt='$fullFileName'>";
            echo "<form method='post'>
                    <button name='delete".$img['id']."' style='display: block; margin: auto'>
                    Удалить
                    </button>
                  </form>
                  </div>";
        }
    }
    echo "</div>";

/*echo "<pre>";
var_dump($_FILES);
echo "</pre>";
echo "<pre>";
var_dump($fileExtension);
echo "</pre>";
echo "<pre>";
var_dump($fileName);
echo "</pre>";*/

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Работа с файлами</title>
    <style>
        body{
            margin: 50px 100px;
            font-size: 25px;
        }

        input, button{
            outline: none;
            font-size: 25px;
        }
    </style>
</head>
<body>
    <!--// вслучае отправки файлов на сервер необходитмо поставить enctype="multipart/form-data"-->
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="file" required>
        <button name="submit">Отправить</button>
    </form>

</body>
</html>