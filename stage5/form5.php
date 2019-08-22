<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <link href="https://use.fontawesome.com/releases/v5.9.0/css/all.css" rel="stylesheet">
    <style>
        .sub-menu { opacity: 0;}
        #authorization {
            padding: 10px 22px 12px 21px;
            background-color: #d92727;
            border: 1px solid #d92727;
            color: #fff;
        }
    </style>
    <style>
        @import url("/nina-iaremenko-jsfw1-basis/stage5/style/header.css");
        @import url("/nina-iaremenko-jsfw1-basis/stage5/style/main.css");
        @import url("/nina-iaremenko-jsfw1-basis/stage5/style/footer.css");

    </style>
    <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>
</head>
<body>
    <div class="wrapper">
        <header>
            <div class="container">
                <a class="logo" href="#">
                    <img src="/nina-iaremenko-jsfw1-basis/stage5/images/logoform.png" alt="">
                </a>
                <input type="checkbox" id="hmt" class="hidden-menu-ticker">
                <label class="btn-menu" for="hmt">
                    <span class="first"></span>
                    <span class="second"></span>
                    <span class="third"></span>
                </label>
                <nav class="header-menu">
                    <button id="auth" type="button" >Authorization</button>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li>
                            <a id="course" href="#">Courses<img src="/nina-iaremenko-jsfw1-basis/stage5/images/arrow_down.png" alt=""></a>
                            <ul class="sub-menu">
                                <li><a href="#">Courses 1</a></li>
                                <li><a href="#">Courses 2</a></li>
                                <li><a href="#">Courses 3</a></li>
                            </ul>
                        </li>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Video</a></li>
                        <li>
                            <a href="#">Interesting<img src="/nina-iaremenko-jsfw1-basis/stage5/images/arrow_down.png" alt=""></a>
                            <ul class="sub-menu">
                                <li><a href="#">Interesting 1</a></li>
                                <li><a href="#">Interesting 2</a></li>
                                <li><a href="#">Interesting 3</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <button id="authorization" type="button" >Authorization</button>
                <span class="x-off-canvas-bg open-close-menu"></span>
            </div>
        </header>

        <div class="main">
            <form class="form" action="" method="post" enctype = 'multipart/form-data' ">
                <fieldset>
                    <label for="fio">ФИО </label><br>
                    <input id="fio" type="text" name="fio" value="" >
                    <span class="error"> </span>
                    <br>
                    <label for="email">E-mail </label><br>
                    <input id="email" type="text" name="email" value="" >
                    <span class="error"> </span>
                    <br>
                    <div id="phone_container">
                        <div class="form-group">
                            <div class="form-control">
                                <label for="phone0" >Телефон </label><br>
                                <input id="phone0" name="phone[]" class="phones" type="text" data-validate="0" value="">
                                <span class="error"> </span>
                            </div>
                            <div class="form-control">
                                <input id="plus" type="button" name="plus" value="+"><br>
                            </div>
                        </div>
                    </div>

                    <label for="age">Возраст </label><br>
                    <input id="age" type="text" name="age" value="">
                    <span class="error"> </span>
                    <br>
                    <div id="foto_container">
                        <span>Фотография </span><br>
                        <label for="photo">
                            <div id="label-photo-box">
                                <img src="/nina-iaremenko-jsfw1-basis/stage5/images/upload.png" alt="Upload foto">
                            </div>

                        </label>
                        <input id="photo" type="file" name="photo" />
                        <span class="error"> </span>
                    </div>
                    <span class="error"> </span>
                    <div id="resume_box">
                        <label for="resume">Резюме </label><br>
                        <textarea id="resume" name="resume" ></textarea>
                        <span class="error"> </span>
                        <br><br>
                    </div>
                    <input id="submit" type="submit" name="uploadBtn" value="Отправить" />
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
                                <li><a href="#">Project management</a></li>
                                <li><a href="#">Android development</a></li>
                                <li><a href="#">Online marketing</a></li>
                                <li><a href="#">Front-end developer</a></li>
                            </ul>
                        </li>

                    </ul>
                </div>
                <div id="center_box">
                    <ul>
                        <li>
                            <a href="#">Interesting</a>
                            <ul>
                                <li><a href="#">Blog</a></li>
                                <li><a href="#">Youtube</a></li>
                                <li><a href="#">Team</a></li>
                                <li><a href="#">Community</a></li>
                            </ul>
                        </li>

                    </ul>
                </div>
                <div id="right_box">
                    <ul>
                        <li>
                            <a href="#">Social networks</a>
                            <ul>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </div>
            <div id="bottom_footer">
                <div>Terms of Service</div>
                <div>Privacy policy</div>
            </div>

        </footer>
    </div>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>