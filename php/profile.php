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



<div id="fh5co-about" class="animate-box">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-offset-2 text-center fh5co-heading">
                <h2>Мой профиль</h2>
            </div>
        </div>
        <div class="row" >
            <div class="col-12 col-lg-3">
                <div class="row" id="menublock">
                    <ul class="infolink" id="menulink">
                        <li><a href="#" id="menu1">Личная информация</a></li>
                        <li><a href="#" id="menu2">Мои объявления</a></li>
                        <li><a href="#" id="menu3">Мои заявки</a></li>
                        <li><a href="#" id="menu4">Избранное</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-lg-9">
                <div class="row" id="menu_block_1">
                    <div class="row align-items-center mb-2 mt-3">
                        <div class="form-group col-lg-5">
                            <div class="text ">Ремизов Александр</div>
                        </div>
                        <div class="form-group  col-lg-4">
                            <input type="password" class="form-control" id="inputPassword2" placeholder="Имя">
                        </div>
                        <div class="form-group  col-lg-3" >
                            <div class="form_button mt-md-2">
                                <button type="button" class="submitbutton" id="submitreg">Изменить</button>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center mb-2">
                        <div class="form-group col-lg-5">
                            <div class="text ">Телефон</div>
                        </div>
                        <div class="form-group  col-lg-4">
                            <input type="password" class="form-control" id="inputPassword2" placeholder="Телефон">
                        </div>
                        <div class="form-group  col-lg-3">
                            <div class="form_button mt-md-2">
                                <button type="button" class="submitbutton" id="submitreg">Изменить</button>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center mb-2">
                        <div class="form-group col-lg-5">
                            <div class="text ">email@example</div>
                        </div>
                        <div class="form-group  col-lg-4">
                            <input type="password" class="form-control" id="inputPassword2" placeholder="Почта">
                        </div>
                        <div class="form-group  col-lg-3">
                            <div class="form_button mt-md-2">
                                <button type="button" class="submitbutton" id="submitreg">Изменить</button>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center mb-2">
                        <div class="form-group col-lg-5">
                            <div class="text ">email@example.com</div>
                        </div>
                        <div class="form-group  col-lg-4">
                            <input type="password" class="form-control" id="inputPassword2" placeholder="Пароль">
                        </div>
                        <div class="form-group  col-lg-3">
                            <div class="form_button mt-md-2">
                                <button type="button" class="submitbutton" id="submitreg">Изменить</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3" id="menu_block_2">
                    <div class="annoutblock" id="annoutblock"></div>
                    <div class="show-more-container"><button class="show-more-profile">Показать ещё</button></div>
                </div>
                <div class="row mt-3" id="menu_block_3">
                    <div class="col-4"><div class="text">Объявление</div></div>
                    <div class="col-4"><div class="text">Сообщение</div></div>
                    <div class="col-4"><div class="text">Дата</div></div>
                    <div class="col-4"><div class="text">текст</div></div>
                    <div class="col-4"><div class="text">текст</div></div>
                    <div class="col-4"><div class="text">дата</div></div>
                </div>
                <div class="row mt-3" id="menu_block_4">
                    <div class="col-5"><div class="text">Имя</div></div>
                    <div class="col-5"><div class="text">Ссылка на профиль</div></div>
                    <div class="col-5"><div class="text">Какое нибудь имя</div></div>
                    <div class="col-5"><div class="text">ссылка в сибирь</div></div>
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
<script src="../js/ProfileMenu.js"></script>
</body>
</html>

