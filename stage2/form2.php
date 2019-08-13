<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>

</head>
<body>
    <form action="" method="post" enctype = 'multipart/form-data'>
        <fieldset>
            <label for="fio">ФИО </label><input id="fio" type="text" name="fio" value="" >
            <span class="error"> </span>
            <br><br>
            <label for="email">Email </label><input id="email" type="text" name="email" value="" >
            <span class="error"> </span>
            <br><br>
            <div id="phone_container">
                <label for="phone0" >Телефон </label><input id="phone0" class="phones" type="text" name="value[]" data-validate="1" placeholder="+380(xx)xxx-x-xxx">
                <span class="error"> </span>
                <br><br>
            </div>

            <input id="button" type="button" name="plus" value="Добавить телефон"><br><br><br>

            <label for="age">Возраст </label><input id="age" type="text" name="age" value="">
            <span class="error"> </span>
            <br><br>
            <span>Загрузить фото: </span><input id="photo" type="file" name="photo" />
            <span class="error"> </span>
            <br><br>
            <label for="resume">Резюме: </label><textarea id="resume" rows="10" cols="45" name="resume" ></textarea>
            <span class="error"> </span>
            <br><br>
            <input type="submit" name="uploadBtn" value="Отправить" />

        </fieldset>
        <div>

        </div>

    </form>
    <br>
    <div id="formValue">
        <div id="fio_inner"></div>
        <div id="email_inner"></div>
        <div id="phones_inner"></div>
        <div id="age_inner"></div>
        <div id="photo_inner"></div>
        <div id="resume_inner"></div>
    </div>
    <script type="text/javascript" src="/nina-iaremenko-jsfw1-basis/stage2/script.js"></script>
</body>
</html>