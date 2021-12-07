<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Профиль</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/profile.css">
</head>
<body>
<header class="header" id="header">
    <div class="container">
        <div class="nav">
            <div class="logo">
                <img src="../img/mainicon.png" alt="logo" class="logopic">
                <p class="logotext">ExSB</p>
            </div>
            <div class="menu_block" id = "menu_block" >
                <?php
                if($_SESSION['user']){
                    echo '
                <ul class="menu" id = "menu" >
                    <li >
                        <a href = "#" class="menu_obj_text" id="mainlink" >Главная</a >
                    </li >
                    <li >
                        <a href = "#profile" class="menu_obj_text" id="profilelink" >Профиль</a >
                    </li >
                    <li >
                        <a href = "../vendor/annount/addAnnount.php" class="menu_obj_text" id="addAnnount" >Добавить объявление</a >
                    </li >
                    <li >
                        <a href = "#findAnnount" class="menu_obj_text" id="findAnnount" >Найти объявление</a >
                    </li >
                    <li >
                        <a href = "../vendor/exit.php" class="menu_obj_text" id="exit" >Выйти</a >
                    </li >
                </ul >';
                } else {
                    echo '
                <ul class="menu" id = "menu" >
                    <li >
                        <a href = "#" class="menu_obj_text" class="mainlink" >Главная</a >
                    </li >
                    <li >
                        <a href = "#log" class="menu_obj_text" class="loglink" >Вход</a >
                    </li >
                    <li >
                        <a href = "#reg" class="menu_obj_text" class="reglink" >Регистрация</a >
                    </li >
                </ul >';
                }
                ?>
                <a class="burger" id="burger">
                    <span></span>
                    <p class="menu_text">Меню</p>
                </a>
            </div>
</header>

<div class="container">
    <div class="row align-items-center">
        <div class="col-4 col-lg-2 mt-3"><div class="text-center">Имя продавца</div></div>
        <div class="col-6 col-lg-5 mt-3">
            <div class="form_button mt-md-2 ">
                <button type="button" class="submitbutton" id="buttondetailpagesubmit">Следить</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-3"><div class="text-end">30 февраля 2021</div></div>
        <div class="col-12 mt-3">
            <div class="h4 text-center">Жига</div>
        </div>
    </div>
    <div class="row ">
        <div class="col-12 col-md-6">
            <img src="../img/ann/1.jpg" class="img-fluid" alt="...">
        </div>
        <div class="col-12 col-md-6">
            <div class="col-12 col-md-6"><div class="h5 text-center">Описание</div></div>
            <div class="col-12 col-md-6"><div class="text">Как новая</div></div>
            <div class="row align-items-center">
                <div class="col-12 col-md-5">
                    <div class="h5 text-center">55 000₽</div>
                </div>
                <div class="col-12 col-md-7">
                    <div class="form_button ">
                        <button type="button" class="submitbutton" id="buttondetailpagebuy">Купить</button>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-12">
            <footer class="footer" id="footer">
                <h1 class="footertext">Сайт разработан Александром Ремизовым и Евгением Гришагиным.</h1>
            </footer>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>