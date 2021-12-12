<?php
session_start();
if(!$_SESSION['user']) {
    header('Location: ../../index.php');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Профиль</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/profile.css">
</head>
<body>

<header class="header" id="header">
    <div class="container">
                <?php
                include '../nav.php';
                echo $NavBar;
                ?>
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
                            <div class="text ">Имя:</div>
                        </div>
                        <div class="form-group  col-lg-4">
                            <input type="text" class="form-control" value="<?php require_once 'ProfileInfoLoader.php'; print_r($UserInfo["name"]); ?>" id="name_bar" disabled>
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
                            <input type="text" class="form-control" id="phone_bar" value="<?php require_once 'ProfileInfoLoader.php'; print_r($UserInfo["phone"]); ?>" placeholder="Телефон" disabled>
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
                            <input type="email" class="form-control" id="mail_bar" value="<?php require_once 'ProfileInfoLoader.php'; print_r($UserInfo["email"]); ?>"       placeholder="Почта" disabled>
                        </div>
                        <div class="form-group  col-lg-3">
                            <div class="form_button mt-md-2">
                                <button type="button" class="submitbutton" id="submitreg">Изменить</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="menu_block_2">
                    <div class="annoutblock" id="annoutblock">
                        <?php require_once 'ProfileInfoLoader.php';
                        foreach($UserAnn as $ann){
                            print_r('<div class="annbox">
<a href="#" class="annname">'.$ann["name"].'</a>
                <img src=" ../img/uploads/'.$ann["picture"].'" class="annimg">
                <p class="annabout">Цена: '.$ann["price"].'</p>
                <p class="annabout">Опубликовано в: '.$ann["publication_time"].'</p>
                <a class="annlink">Откликнуться</a></div>');
                        } ?>
                    </div>
                    <div class="show-more-container">
                        <button class="submitbutton" id="show-more-profile">Показать ещё</button>
                    </div>
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


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="/js/ProfileMenu.js"></script>
<script src="/js/AnnountLoader.js"></script>
</body>
</html>

