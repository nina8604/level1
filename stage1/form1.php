<?php
    include 'dbconnect.php';
    // variable list
    $fioErr = $emailErr = $phoneErr = $ageErr = $photoErr = $resumeErr = "";
    $fio = $email = $phone = $age = $photo = $resume = "";
    // counter input plus phone
    $c = (isset($_POST['pc']))?$_POST['pc']:'0';
    if ( isset($_POST['plus']) ) $c++;

//    $fio = (isset($_POST['fio']))?$_POST['fio']:'';
//    $email = (isset($_POST['email']))?$_POST['email']:'';
//    $phone = (isset($_POST['phone']))?$_POST['phone']:'';
//    $age = (isset($_POST['age']))?$_POST['age']:'';
//    $resume = (isset($_POST['resume']))?$_POST['resume']:'';
//    $uploadfile = '';

    if (isset($_POST['uploadBtn'])) {
        if (empty($_POST["fio"])) {
            $fioErr = "ФИО обязательно";
        } else {
            $fio = test_input($_POST["fio"]);
            // check if fio only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z ]*$/",$fio)) {
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
            $phone = test_input ($_POST["phone"]);
            $phone = preg_replace('/\s|\+|-|\(|\)/','', $phone);
            if (is_numeric($phone)) {
                if (strlen($phone) < 5) {
                    $phoneErr = "Неверно введен телефон. Повторите попытку";
                }
            }
            else $phoneErr = "Неверный формат данных. Повторите попытку";
        }

        if (empty($_POST["age"])) {
            $ageErr = "Возраст обязательный";
        } else {
            $age = test_input($_POST["age"]);
            if ( is_numeric ($age)) {
                if ( $age > 150) {
                    $ageErr = "Данные введены не верно. Повторите попытку";
                }
            }
            else $ageErr = "Неверный формат данных. Повторите попытку";
        }

        if(isset($_FILES['photo'])){
            $photoErr = array();
            $file_name = $_FILES['photo']['name'];
            $file_size =$_FILES['photo']['size'];
            $file_tmp =$_FILES['photo']['tmp_name'];
            $file_type=$_FILES['photo']['type'];
            $file_ext=strtolower(end(explode('.',$_FILES['photo']['name'])));

            $extensions= array("jpeg","jpg","png");

            if(in_array($file_ext,$extensions)=== false){
                $photoErr[]="extension not allowed, please choose a JPEG or PNG file.";
            }

            if($file_size > 2097152){
                $photoErr[]='File size must be excately 2 MB';
            }

            if(empty($photoErr)==true){
                if(move_uploaded_file($file_tmp,"images/".$file_name)) {
                    $uploadfile = "images/".$file_name;
                    echo $uploadfile."<br>";
                    echo "Success";
                }
                else echo "Файл не перенесен в images";
            }else{
                print_r($photoErr);
            }
        }


//        if (!empty($_FILES['photo']['name'])){
//            $uploaddir='/nina-iaremenko-jsfw1-basis/stage1/images/';
////            echo $uploaddir ."<br>";
//            $uploadfile = $uploaddir.basename($_FILES['photo']['name']);
////            echo $uploadfile ."<br>";
//            if (!is_uploaded_file($_FILES['photo']['tmp_name']) || !move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile)){
//                $photoErr = 'ошибка передачи файла';
//                echo $photoErr ."<br>";
//            }
//
//        }

//        if (empty($_FILES) || !isset($_FILES['photo'])) {
//            $photoErr = 'Файл не выбран';
//        }else {
//            $image_data = $_FILES['photo'];
//            $file_type_data = explode('/', $image_data);
//            $file_type = $file_type_data[1];
//            $new_file_name = bcrypt(timestamp()) . '.' . $file_type;
////            move_uploaded_file('$image_data[\'tmp_name\']', "/nina-iaremenko-jsfw1-basis/stage1/images/$new_file_name");
//            copy('$image_data[\'tmp_name\']', '/nina-iaremenko-jsfw1-basis/stage1/images/$new_file_name');
//        }

//        if (empty($_POST["photo"])) {
//            $photoErr = 'Файл не выбран';
//        } else {
//            if(is_file($_POST["photo"])) {
//
//            }
//            $photo_name = $_FILES["photo"]["name"];
//            $photo = addslashes(file_get_contents($_FILES['photo']['tmp_name']));
//
//        }

        if (empty($_POST["resume"])) {
            $resumeErr = "Введите данные";
        } else {
            $resume = test_input($_POST["resume"]);
        }
        if ($fioErr == "" && $emailErr == "" && $phoneErr == "" && $ageErr == "" && $photoErr == array() && $resumeErr == "") {
            $link = mysqli_connect('localhost', 'pmauser', 'YkCx6d2N605D', 'nina_iaremenko_jsfw');
            if (!$link) {
                echo "Ошибка:".mysqli_connect_errno().':'.mysqli_connect_error();
            }
            else echo "Соединение с базой прошло успешно";
//            var_dump($_FILES);
//            var_dump($_POST);die;
//            echo  "<br>".$fio."<br>";
//            echo  "<br>".$email."<br>";
//            echo  "<br>".$age."<br>";
//            echo  "<br>".$uploadfile."<br>";
//            echo  "<br>".$resume."<br>";


//    echo substr(sprintf('%o', fileperms('/nina-iaremenko-jsfw1-basis/stage1/images')), -4); die;
            $sql = "INSERT INTO user (fio, email, age, photo, resume) VALUES ('$fio', '$email', '$age', '$uploadfile', '$resume');";
            mysqli_query($link, $sql);
            $user_id = mysqli_insert_id();
            $sql2 = "INSERT INTO phones (user_id, phones) VALUES ( '$user_id', '$phone');";
            mysqli_query($link, $sql2);
            mysqli_close($link);
        }else echo "Данные не были занесены в базу данных";

    }

    function test_input($data) {
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
<form action="" method="post" enctype = 'multipart/form-data'>
    <fieldset>
        <label for="fio">ФИО </label><input type="text" name="fio" value="<?=$fio?>" >
        <span class="error">* <?php echo $fioErr;?></span>
        <br><br>
        <label for="email">Email </label><input type="text" name="email" value="<?=$email?>" >
        <span class="error">* <?php echo $emailErr;?></span>
        <br><br>
        <label for="phone">Телефон </label><input type="text" name="phone" value="<?=$phone?>" >
        <span class="error"> <?php echo $phoneErr;?></span>
        <br><br>
        <input type="submit" name="plus" value="Добавить телефон" >
        <input type="hidden" name='pc' value='<?=$c?>'>
        <br><br>

        <?php
        for ($i = 1; $i <= $c; $i++)
            echo '<label for="phone'. $i .'">Телефон '. $i .' </label><input type="text" name="phone'. $i .'" value="'. $_POST['phone'.$i] .'"><br><br>'. PHP_EOL;
        ?>

        <label for="age">Возраст </label><input type="text" name="age" value="<?=$age?>" >
        <span class="error">* <?php echo $ageErr;?></span>
        <br><br>
        <span>Загрузить фото: </span><input type="file" name="photo" />
        <br><br>
        <label for="resume">Резюме: </label><textarea rows="10" cols="45" name="resume" ><?php echo $resume;?></textarea>
        <span class="error"> <?php echo $resumeErr;?></span>
        <br><br>
        <input type="submit" name="uploadBtn" value="Отправить" />

    </fieldset>


</form>
</body>
</html>