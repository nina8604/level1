<?php
    // variable list
    $fioErr = $emailErr = $phoneErr = $ageErr = $photoErr = $resumeErr = "";
    $fio = $email = $phone = $age = $photo = $resume = "";
    // counter input plus phone
    $c = (isset($_POST['pc']))?$_POST['pc']:'0';
    if ( isset($_POST['plus']) ) $c++;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["fio"])) {
            $nameErr = "ФИО обязательно";
        } else {
            $fio = test_input($_POST["fio"]);
            // check if fio only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z ]*$/",$fio)) {
                $fioErr = "Разрешены только буквы и пробелы. Повторите попытку снова";
            }
        }

        if (empty($_POST["email"])) {
            $emailErr = "Email обязательно";
        } else {
            $email = test_input($_POST["email"]);
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Неверный формат email. Повторите попытку снова";
            }
        }

        if (empty($_POST["phone"])) {
            $phone = " ";
        } else {
            $phone = test_input($_POST["phone"]);
            // check if phone syntax is valid
            if (!preg_match(" ",$phone)) {
                $phoneErr = "Неверно введен телефон. Повторите попытку снова";
            }
        }

        if (empty($_POST["age"])) {
            $ageErr = "Возраст обязательный";
        } else {
            $age = test_input($_POST["age"]);
            // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
            if (!preg_match(" ",$age)) {
                $ageErr = "Неверный формат данных. Повторите попытку снова";
            }
        }

//        if (empty($_POST["photo"])) {
//            $photo = "";
//        } else {
//
//        }

//        if (empty($_POST["resume"])) {
//            $resumeErr = "Пол обязательно";
//        } else {
//            $resume = test_input($_POST["resume"]);
//        }
    }

//    $fio = (isset($_POST['fio']))?$_POST['fio']:'';
//    $email = (isset($_POST['email']))?$_POST['email']:'';
//    $phone = (isset($_POST['phone']))?$_POST['phone']:'';
//    $age = (isset($_POST['age']))?$_POST['age']:'';
//    $resume = (isset($_POST['resume']))?$_POST['resume']:'';
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
        <label for="fio">ФИО </label><input type="text" name="fio" value="<?=$fio?>" ><br>
        <label for="email">Email </label><input type="text" name="email" value="<?=$email?>" ><br>
        <label for="phone">Телефон </label><input type="text" name="phone" value="<?=$phone?>" > <br>
        <input type="submit" name="plus" value="Добавить телефон" >
        <input type="hidden" name='pc' value='<?=$c?>'>

        <?php
        for ($i = 1; $i <= $c; $i++)
            echo '<label for="phone'. $i .'">Телефон '. $i .' </label><input type="text" name="phone'. $i .'" value="'. $_POST['phone'.$i] .'"><br>'. PHP_EOL;
        ?>

        <label for="age">Возраст </label><input type="text" name="age" value="<?=$age?>" ><br>
        <span>Загрузить фото: </span><input type="file" name="uploadedFile" /><br>
        <label for="resume">Резюме: </label><textarea rows="10" cols="45" name="resume" value="<?=$resume?>" ></textarea><br>
        <input type="submit" name="uploadBtn" value="Отправить" />

    </fieldset>

</form>
</body>
</html>