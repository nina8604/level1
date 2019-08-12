<?php
// constant list
const NEW_FILE_DIR = "/nina-iaremenko-jsfw1-basis/stage1/images/";
// variable list
$phonesErr = $photoErr = [];
$fioErr = $emailErr = $phoneErr = $ageErr = $resumeErr = $dataErr = "";

$fio = $email = $phone = $age = $photo = $resume = $success = "";
// counter input plus phone
$c = (isset($_POST['pc'])) ? $_POST['pc'] : '0';
if (isset($_POST['plus'])) $c++;
$fio = (isset($_POST['fio'])) ? $_POST['fio'] : '';
$email = (isset($_POST['email'])) ? $_POST['email'] : '';
$phone = (isset($_POST['phone'])) ? $_POST['phone'] : '';
$age = (isset($_POST['age'])) ? $_POST['age'] : '';
$resume = (isset($_POST['resume'])) ? $_POST['resume'] : '';
if (isset($_POST['uploadBtn'])) {
    if (empty($_POST["fio"])) {
        $fioErr = "ФИО обязательно";
    } else {
        $fio = test_input($_POST["fio"]);
        // check if fio only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/", $fio)) {
            $fioErr = "Разрешены только буквы и пробелы. Повторите попытку";
        }
    }
    if (empty($_POST["email"])) {
        $emailErr = "Email обязательно";
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Неверный формат email. Повторите попытку";
        }
    }
    if (empty($_POST["phone"])) {
        $phone = " ";
    } else {
        $phone = test_input($_POST["phone"]);
        $phone = preg_replace('/\s|\+|-|\(|\)/', '', $phone);
        if (is_numeric($phone)) {
            if (strlen($phone) < 5) {
                $phoneErr = "Неверно введен телефон. Повторите попытку";
            }
        } else $phoneErr = "Неверный формат данных. Повторите попытку";
    }

    for ($i = 0; $i <= $c; $i++) {
//            $phonesErr = [];
//            $phones = [];
        if (empty($_POST['phone' . $i])) {
            $phonesErr[$i] = "Введите телефон";
        } else {
            $phones[$i] = test_input($_POST['phone' . $i]);
            $phones[$i] = preg_replace('/\s|\+|-|\(|\)/', '', $phones[$i]);
            if (is_numeric($phones[$i])) {
                if (strlen($phones[$i]) < 5) {
                    $phonesErr[$i] = "Неверно введен телефон. Повторите попытку";
                }
            } else $phonesErr[$i] = "Неверный формат данных. Повторите попытку";
        }
    }

    if (empty($_POST["age"])) {
        $ageErr = "Возраст обязательный";
    } else {
        $age = test_input($_POST["age"]);
        if (is_numeric($age)) {
            if ($age > 150) {
                $ageErr = "Данные введены не верно. Повторите попытку";
            }
        } else $ageErr = "Неверный формат данных. Повторите попытку";
    }

    if (isset($_FILES['photo'])) {
        $photoErr = array();
        $file_name = $_FILES['photo']['name'];
        $file_size = $_FILES['photo']['size'];
        $file_tmp = $_FILES['photo']['tmp_name'];
        $file_type = $_FILES['photo']['type'];
        $file_ext = strtolower(end(explode('.', $_FILES['photo']['name'])));
        $extensions = array("jpeg", "jpg", "png");
        if (in_array($file_ext, $extensions) === false) {
            $photoErr[] = "extension not allowed, please choose a JPEG or PNG file.";
        }
        if ($file_size > 2097152) {
            $photoErr[] = 'File size must be excately 2 MB';
        }
        if (empty($photoErr)) {
            $uploadfile = $_SERVER['DOCUMENT_ROOT'] . NEW_FILE_DIR . $file_name;

            if (!copy($file_tmp, $uploadfile)) {
                $photoErr[] = "Файл не перенесен в images";
                echo "Файл не перенесен в images";
            }
        } else {
            print_r($photoErr);
        }
    }
    if (empty($_POST["resume"])) {
        $resumeErr = "Введите данные";
    } else {
        $resume = test_input($_POST["resume"]);
    }
    if ($fioErr == "" && $emailErr == "" && $phoneErr == "" && $phonesErr == [] && $ageErr == "" && $photoErr == [] && $resumeErr == "") {
        $link = mysqli_connect('localhost', 'pmauser', 'YkCx6d2N605D', 'nina_iaremenko_jsfw');
        if (!$link) {
            echo "Ошибка:" . mysqli_connect_errno() . ':' . mysqli_connect_error();
        }
//            else echo "Соединение с базой прошло успешно";
        $sql = "INSERT INTO `users` (fio, email, age, photo, resume) VALUES ('$fio', '$email', '$age', '$uploadfile', '$resume');";
        $result_user = mysqli_query($link, $sql);
        if ($result_user) {
            $user_id = mysqli_insert_id($link);
            $sql2 = "INSERT INTO `phones` (user_id, phones) VALUES ( '$user_id', '$phone');";
            $result_phone = mysqli_query($link, $sql2);
            $result_phones = [];
            foreach ($phones as $add_phone) {
                $sql_phones = "INSERT INTO `phones` (user_id, phones) VALUES ( '$user_id', '$add_phone');";
                $result_phones[] = mysqli_query($link, $sql_phones);
            }
        }
        mysqli_close($link);
        if ($result_user && $result_phone && $result_phones) {
            $fio = $email = $phone = $age = $photo = $resume = "";
            $phones = [];
            $success = "Данные в базу данных занесены успешно";
        }
    } else $dataErr = "Данные в базу данных занесены не были";
}

function test_input($data)
{
    $data = trim($data); // removes spaces (or other characters) from the beginning and end of a line
    $data = stripslashes($data); // removes character escaping
    $data = htmlspecialchars($data); // converts special characters to HTML entities
    return $data;
}

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
<form action="" method="post" enctype='multipart/form-data'>
    <fieldset>
        <label for="fio">ФИО </label><input type="text" name="fio" value="<?= $fio ?>">
        <span class="error">* <?php echo $fioErr; ?></span>
        <br><br>
        <label for="email">Email </label><input type="text" name="email" value="<?= $email ?>">
        <span class="error">* <?php echo $emailErr; ?></span>
        <br><br>
        <label for="phone">Телефон </label><input type="text" name="phone" value="<?= $phone ?>">
        <span class="error"> <?php echo $phoneErr; ?></span>
        <br><br>
        <input type="submit" name="plus" value="Добавить телефон">
        <input type="hidden" name='pc' value='<?= $c ?>'>
        <br><br>

        <?php
        for ($i = 1; $i <= $c; $i++)
            echo '<label for="phone' . $i . '">Телефон ' . $i . ' </label><input type="text" name="phone' . $i . '" value="' . $phones[$i] . '">
                    <span class="error">' . $phonesErr[$i] . '</span><br><br>' . PHP_EOL;
        ?>

        <br>

        <label for="age">Возраст </label><input type="text" name="age" value="<?= $age ?>">
        <span class="error">* <?php echo $ageErr; ?></span>
        <br><br>
        <span>Загрузить фото: </span><input type="file" name="photo"/>
        <br><br>
        <label for="resume">Резюме: </label><textarea rows="10" cols="45"
                                                      name="resume"><?php echo $resume; ?></textarea>
        <span class="error"> <?php echo $resumeErr; ?></span>
        <br><br>
        <input type="submit" name="uploadBtn" value="Отправить"/>

    </fieldset>
    <div>
        <span><?php echo $success; ?></span>
        <span><?php echo $dataErr; ?></span>
    </div>

</form>
</body>
</html>