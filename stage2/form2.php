<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script
        src="https://code.jquery.com/jquery-3.4.0.min.js"
        integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg="
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="/nina-iaremenko-jsfw1-basis/stage2/script.js"></script>
</head>
<body>
    <form action="" method="post" enctype = 'multipart/form-data'>
        <fieldset>
            <label for="fio">ФИО </label><input type="text" name="fio" value="" >
            <span class="error">* </span>
            <br><br>
            <label for="email">Email </label><input type="text" name="email" value="" >
            <span class="error">* </span>
            <br><br>
            <label for="phone">Телефон </label><input type="text" name="phone" value="" >
            <span class="error"> </span>
            <br><br>
            <input type="submit" name="plus" value="Добавить телефон" >
            <input type="hidden" name='pc' value='<?=$c?>'>
            <br><br>

<!--            --><?php
//            for ($i = 1; $i <= $c; $i++)
//                echo '<label for="phone'. $i .'">Телефон '. $i .' </label><input type="text" name="phone'. $i .'" value="'. $phones[$i] .'">
//                        <span class="error">'.$phonesErr[$i].'</span><br><br>'. PHP_EOL;
//            ?>

            <br>

            <label for="age">Возраст </label><input type="text" name="age" value="" >
            <span class="error">* </span>
            <br><br>
            <span>Загрузить фото: </span><input type="file" name="photo" />
            <br><br>
            <label for="resume">Резюме: </label><textarea rows="10" cols="45" name="resume" ></textarea>
            <span class="error"> </span>
            <br><br>
            <input type="submit" name="uploadBtn" value="Отправить" />

        </fieldset>
        <div>

        </div>

    </form>
<!--    <form action="" method="post" name="Form">-->
<!--        <div id="DynamicExtraFieldsContainer">-->
<!--            <div id="addDynamicField">-->
<!--                <input type="button" id="addDynamicExtraFieldButton" value="Добавить динамическое поле">-->
<!--            </div>-->
<!--            <div class="DynamicExtraField">-->
<!--                <br>-->
<!--                <label for="DynamicExtraField">Доп. поле </label> <input value="Удаление" type="button" class="DeleteDynamicExtraField">-->
<!--                <br>-->
<!--                <textarea name="DynamicExtraField[]" cols="50">test</textarea>-->
<!--            </div>-->
<!--        </div>-->
<!--    </form>-->

</body>
</html>