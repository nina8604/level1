<?php
//if (isset($_POST['uploadBtn']) && $fioErr == "" && $emailErr == "" && $phoneErr == "" && $ageErr == "" && $photoErr == "" && $resumeErr == ""){
//
//    $link = mysqli_connect('localhost', 'pmauser', 'YkCx6d2N605D', 'nina_iaremenko_jsfw');
//    if (!$link) {
//        echo "Ошибка:".mysqli_connect_errno().':'.mysqli_connect_error();
//    }
//    else echo "Соединение с базой прошло успешно";
//    var_dump($_FILES);
//    echo  "<br>".$fio."<br>";
//    echo  "<br>".$email."<br>";
//    echo  "<br>".$age."<br>";
//    echo  "<br>".$uploadfile."<br>";
//    echo  "<br>".$resume."<br>";
//
//
////    echo substr(sprintf('%o', fileperms('/nina-iaremenko-jsfw1-basis/stage1/images')), -4); die;
//    $sql = "INSERT INTO user (fio, email, age, photo, resume) VALUES ('$fio', '$email', '$age', '$uploadfile', '$resume');";
//    mysqli_query($link, $sql);
//    $user_id = mysqli_insert_id();
//    $sql2 = "INSERT INTO phones (user_id, phones) VALUES ( '$user_id', '$phone');";
//    mysqli_query($link, $sql2);
//    mysqli_close($link);
//}
