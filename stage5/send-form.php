<?php
// constant list
const NEW_FILE_DIR = "/nina-iaremenko-jsfw1-basis/stage5/images/";
const EXTENSIONS = array("jpeg", "jpg", "png");
const SIZE = 2 * 1024 * 1024;
const HOST = 'localhost';
const ROOT = 'pmauser';
const PASSWORD = 'YkCx6d2N605D';
const DATABASE = 'nina_iaremenko_jsfw';

// variable list
$phonesErr = $photoErr = [];
$allErr = [];
$error = "Данные введены не верно. Повторите попытку.";
$errorEmpty = "*данное поле обязательно для заполнения.";

$fio = (isset($_POST['fio'])) ? $_POST['fio'] : '';
$email = (isset($_POST['email'])) ? $_POST['email'] : '';
$phones = (isset($_POST['phone'])) ? $_POST['phone'] : [];
$age = (isset($_POST['age'])) ? $_POST['age'] : '';
$resume = (isset($_POST['resume'])) ? $_POST['resume'] : '';

function clearInput($data)
{


    $data = trim($data); // removes spaces (or other characters) from the beginning and end of a line
    $data = stripslashes($data); // removes character escaping
    $data = htmlspecialchars($data); // converts special characters to HTML entities
    return $data;
}

if (empty($_POST["fio"])) {
    $allErr['fioErr'] = $errorEmpty;
} else {
    $fio = clearInput($_POST["fio"]);
    // check if fio only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/", $fio)) {
        $allErr['fioErr'] = $error;
    }
}
if (empty($_POST["email"])) {
    $allErr['emailErr'] = $errorEmpty;
} else {
    $email = clearInput($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $allErr['emailErr'] = $error;
    }
}

foreach ($phones as $count => $phone) {
    if (empty($phone)) {
        $phonesErr[$count] = $errorEmpty;
    } else {
        $phone = clearInput($phone);
        $phone = preg_replace('/\s|\+|-|\(|\)/', '', $phone);
        if (is_numeric($phone)) {
            if (strlen($phone) < 5) {
                $phonesErr[$count] = $error;
            }
        } else $phonesErr[$count] = $error;
    }
    $allErr['phonesErr'] = $phonesErr;
}

if (empty($_POST["age"])) {
    $allErr['ageErr'] = $errorEmpty;
} else {
    $age = clearInput($_POST["age"]);
    if (is_numeric($age)) {
        if ($age > 150) {
            $allErr['ageErr'] = $error;
        }
    } else {
        $allErr['ageErr'] = $error;
    }
}
if (isset($_FILES['photo'])) {
    $file_name = $_FILES['photo']['name'];
    $file_size = $_FILES['photo']['size'];
    $file_tmp = $_FILES['photo']['tmp_name'];
    $file_type = $_FILES['photo']['type'];
    $file_ext = strtolower(end(explode('.', $_FILES['photo']['name'])));

    if (in_array($file_ext, EXTENSIONS) === false) {
        $allErr['photoErr'] = "extension not allowed, please choose a JPEG or PNG file.";
    }
    if ($file_size > SIZE) {
        $allErr['photoErr'] = 'File size must be excately 2 MB';
    }
    if (empty($photoErr)) {
        $uploadfile = $_SERVER['DOCUMENT_ROOT'] . NEW_FILE_DIR . $file_name;

        if (!copy($file_tmp, $uploadfile)) {
            $allErr['photoErr'] = "Файл не перенесен в images";
        }
    }
} else {
    $allErr['photoErr'] = $errorEmpty;
}
if (empty($_POST["resume"])) {
    $allErr['resumeErr'] = $errorEmpty;
} else {
    $resume = clearInput($_POST["resume"]);
}

if (count($allErr) > 0) {
    $link = mysqli_connect(HOST, ROOT, PASSWORD, DATABASE);
    if (!$link) {
        echo "Ошибка:" . mysqli_connect_errno() . ':' . mysqli_connect_error();
    }
//        else echo "Соединение с базой прошло успешно";
    $sql = "INSERT INTO `users` (fio, email, age, photo, resume) VALUES ('$fio', '$email', '$age', '$uploadfile', '$resume');";
    $result_user = mysqli_query($link, $sql);
    if ($result_user) {
        $user_id = mysqli_insert_id($link);
        $result_phones = [];
        foreach ($phones as $add_phone) {
            $sql_phones = "INSERT INTO `phones` (user_id, phones) VALUES ( '$user_id', '$add_phone');";
            $result_phones[] = mysqli_query($link, $sql_phones);
        }
    } else $dataErr = "Данные в базу данных занесены не были";
    mysqli_close($link);
    if ($result_user && $result_phones) {
        $fio = $email = $age = $photo = $resume = "";
        $phones = [];
        $success = "Данные в базу данных занесены успешно";
        echo json_encode($success);
    } else echo "Данные в базу данных занесены не были";
} else {
    echo json_encode($allErr);
}


