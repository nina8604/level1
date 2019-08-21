<?php
var_dump($_POST);
// constant list
const NEW_FILE_DIR = "/nina-iaremenko-jsfw1-basis/stage5/images/";
// variable list
$phonesErr = $photoErr = [];
//$fioErr = $emailErr = $phoneErr = $ageErr = $resumeErr = $dataErr = "";
$allErr = [];
$error = "Данные введены не верною. Повторите попытку.";
$errorEmpty = "*данное поле обязательно для заполнения.";

//$fio = $email = $phone = $age = $photo = $resume = $success = "";
// counter input plus phone
$c = (isset($_POST['pc'])) ? $_POST['pc'] : '0';
if (isset($_POST['plus'])) $c++;
$fio = (isset($_POST['fio'])) ? $_POST['fio'] : '';
$email = (isset($_POST['email'])) ? $_POST['email'] : '';
$phone = (isset($_POST['phone'])) ? $_POST['phone'] : '';
$age = (isset($_POST['age'])) ? $_POST['age'] : '';
$resume = (isset($_POST['resume'])) ? $_POST['resume'] : '';
function clearInput($data)
{
    $data = trim($data); // removes spaces (or other characters) from the beginning and end of a line
    $data = stripslashes($data); // removes character escaping
    $data = htmlspecialchars($data); // converts special characters to HTML entities
    return $data;
}
if (isset($_POST['uploadBtn'])) {
    if (empty($_POST["fio"])) {
        $allErr['fioErr'] = $errorEmpty;
//        $fioErr = $errorEmpty;
    } else {
        $fio = clearInput($_POST["fio"]);
        // check if fio only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/", $fio)) {
            $allErr['fioErr'] = $error;
//            $fioErr = $error;
        }
    }
    if (empty($_POST["email"])) {
        $allErr['emailErr'] = $errorEmpty;
//        $emailErr = $errorEmpty;
    } else {
        $email = clearInput($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $allErr['emailErr'] = $error;
//            $emailErr = $error;
        }
    }
    if (empty($_POST["phone"])) {
        $phone = " ";
        $allErr['phoneErr'] = $errorEmpty;
    } else {
        $phone = clearInput($_POST["phone"]);
        $phone = preg_replace('/\s|\+|-|\(|\)/', '', $phone);
        if (is_numeric($phone)) {
            if (strlen($phone) < 5) {
                $allErr['phoneErr'] = $error;
//                $phoneErr = $error;
            }
        } else {
            $allErr['phoneErr'] = $error;
//            $phoneErr = $error;
        }
    }

    for ($i = 0; $i <= $c; $i++) {
        if (empty($_POST['phone' . $i])) {
            $phonesErr[$i] = $errorEmpty;
        } else {
            $phones[$i] = clearInput($_POST['phone' . $i]);
            $phones[$i] = preg_replace('/\s|\+|-|\(|\)/', '', $phones[$i]);
            if (is_numeric($phones[$i])) {
                if (strlen($phones[$i]) < 5) {
                    $phonesErr[$i] = $error;
                }
            } else $phonesErr[$i] = $error;
        }
        $allErr['phonesErr'] = $phonesErr;
    }

    if (empty($_POST["age"])) {
        $allErr['ageErr'] = $errorEmpty;
//        $ageErr = $errorEmpty;
    } else {
        $age = clearInput($_POST["age"]);
        if (is_numeric($age)) {
            if ($age > 150) {
                $allErr['ageErr'] = $error;
//                $ageErr = $error;
            }
        } else {
            $allErr['ageErr'] = $error;
//            $ageErr = $error;
        }
    }

    if (isset($_FILES['photo'])) {
//        $photoErr = array();
        $file_name = $_FILES['photo']['name'];
        $file_size = $_FILES['photo']['size'];
        $file_tmp = $_FILES['photo']['tmp_name'];
        $file_type = $_FILES['photo']['type'];
        $file_ext = strtolower(end(explode('.', $_FILES['photo']['name'])));
        $extensions = array("jpeg", "jpg", "png");
        if (in_array($file_ext, $extensions) === false) {
            $allErr['photoErr'] = "extension not allowed, please choose a JPEG or PNG file.";
//            $photoErr[] = "extension not allowed, please choose a JPEG or PNG file.";
        }
        if ($file_size > 2097152) {
            $allErr['photoErr'] = 'File size must be excately 2 MB';
//            $photoErr[] = 'File size must be excately 2 MB';
        }
        if (empty($photoErr)) {
            $uploadfile = $_SERVER['DOCUMENT_ROOT'] . NEW_FILE_DIR . $file_name;

            if (!copy($file_tmp, $uploadfile)) {
                $allErr['photoErr'] = "Файл не перенесен в images";
//                $photoErr[] = "Файл не перенесен в images";
//                echo "Файл не перенесен в images";
            }
        } else {
//            print_r($photoErr);
        }
    }else {
        $allErr['photoErr'] = $errorEmpty;
//        $photoErr[] = $errorEmpty;
    }
    if (empty($_POST["resume"])) {
        $allErr['resumeErr'] = $errorEmpty;
//        $resumeErr = $errorEmpty;
    } else {
        $resume = clearInput($_POST["resume"]);
    }
    if ($allErr == []){
//    if ($fioErr == "" && $emailErr == "" && $phoneErr == "" && $phonesErr == [] && $ageErr == "" && $photoErr == [] && $resumeErr == "") {
        $link = mysqli_connect('localhost', 'pmauser', 'YkCx6d2N605D', 'nina_iaremenko_jsfw');
        if (!$link) {
            echo "Ошибка:" . mysqli_connect_errno() . ':' . mysqli_connect_error();
        }
//        else echo "Соединение с базой прошло успешно";
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
            return json_encode($success);
        }
    } else {
        $allErr['dataErr'] = "Данные в базу данных занесены не были";
//        $dataErr = "Данные в базу данных занесены не были";
        return json_encode($allErr);
    }

}

