<?php
    $fio = (isset($_POST['fio']))?$_POST['fio']:'';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="" method="post" enctype = 'multipart/form-data'>
    <fieldset>
        <label for="fio">ФИО </label><input type="text" name="fio" value="<?=$fio?>" >

        <input type="submit" name="uploadBtn" value="Отправить" />

    </fieldset>

</form>
<?php

    if (isset($_POST['uploadBtn'])){

        $link = mysqli_connect('localhost', 'pmauser', 'YkCx6d2N605D', 'nina_iaremenko_jsfw');
        if (!$link) {
            echo "Ошибка:".mysqli_connect_errno().':'.mysqli_connect_error();
        }
        else echo "Соединение с базой прошло успешно";
        $sql = "INSERT INTO test (fio) VALUES('$fio');";
        mysqli_query($link, $sql);

        mysqli_close($link);
    }
?>
</body>
</html>
