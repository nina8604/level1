<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.9.0/css/all.css"
          integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <style>
        @import url("/nina-iaremenko-jsfw1-basis/stage3/style/header.css");
        @import url("/nina-iaremenko-jsfw1-basis/stage3/style/main.css");
        @import url("/nina-iaremenko-jsfw1-basis/stage3/style/footer.css");

    </style>

</head>
<body>
    <div class="wrapper">
        <header>
            <div class="container">
                <a class="logo" href="#">
                    <img src="/nina-iaremenko-jsfw1-basis/stage3/images/logoform.png" alt="">
                </a>
                <nav class="header-menu">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li>
                            <a id="course" href="#">Courses</a>
                            <ul class="sub-menu">
                                <li><a href="#">Courses 1</a></li>
                                <li><a href="#">Courses 2</a></li>
                                <li><a href="#">Courses 3</a></li>
                            </ul>
                        </li>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Video</a></li>
                        <li>
                            <a href="#">Interesting</a>
                            <ul class="sub-menu">
                                <li><a href="#">Interesting 1</a></li>
                                <li><a href="#">Interesting 2</a></li>
                                <li><a href="#">Interesting 3</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <button class="autho" type="button" class="btn btn-danger">Authorization</button>
            </div>

        </header>

        <div class="main">
            <form action="" method="post" enctype = 'multipart/form-data' >
                <fieldset>
                    <label for="fio">ФИО </label><br>
                    <input id="fio" type="text" name="fio" value="" >
                    <span class="error"> </span>
                    <br><br>
                    <label for="email">E-mail </label><br>
                    <input id="email" type="text" name="email" value="" >
                    <span class="error"> </span>
                    <br><br>
                    <div id="phone_container">
                        <label for="phone0" >Телефон </label><br>
                        <input id="phone0" class="phones" type="text" data-validate="0">
                        <span class="error"> </span>
                        <input id="plus" type="button" name="plus" value="+"><br>
                        <input id="phone1" class="phones" type="text" data-validate="0">
                        <input id ="delete_phone" type="button" name="delete_extra_phone" value="удалить"><br><br>
                    </div>

                    <label for="age">Возраст </label><br>
                    <input id="age" type="text" name="age" value="">
                    <span class="error"> </span>
                    <br><br>
                    <div id="foto_container">
                        <span>Фотография </span><br>
                        <label for="photo">
                            <div id="label-photo-box">
                                <img src="/nina-iaremenko-jsfw1-basis/stage3/images/upload.png" alt="Upload foto">
                            </div>

                        </label>
                        <input id="photo" type="file" name="photo" />
                    </div>
                    <span class="error"> </span>
                    <label for="resume">Резюме </label><br>
                    <textarea id="resume" rows="19" cols="56" name="resume" ></textarea>
                    <span class="error"> </span>
                    <br><br>

                </fieldset>
            </form>
        </div>

        <footer>
            <div id="footer-menu">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a id="course" href="#">Courses</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Video</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            <div id="middle_footer">
                <div id="left_box">
                    <ul>
                        <li>
                            <a href="#">Courses</a>
                            <ul>
                                <li>Project management</li>
                                <li>Android development</li>
                                <li>Online marketing</li>
                                <li>Front-end developer</li>
                            </ul>
                        </li>

                    </ul>
                </div>
                <div id="center_box">
                    <ul>
                        <li>
                            <a href="#">Interesting</a>
                            <ul>
                                <li>Blog</li>
                                <li>Youtube</li>
                                <li>Team</li>
                                <li>Community</li>
                            </ul>
                        </li>

                    </ul>
                </div>
                <div id="right_box">
                    <ul>
                        <li>
                            <a href="#">Social networks</a>
                            <ul>
                                <li>Blog</li>
                                <li>Youtube</li>
                                <li>Team</li>
                                <li>Community</li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </div>
            <div id="buttom_footer">
                <div>Terms of Service</div>
                <div>Privacy policy</div>
            </div>

        </footer>
    </div>
</body>
</html>
