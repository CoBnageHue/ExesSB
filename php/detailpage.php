<?php
session_start();
if(!$_SESSION['user']) {
    header('Location: ../index.php');
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
            include 'nav.php';
            echo $NavBar;
            ?>
</header>

<div class="container">
    <div class="row">
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
            <div class="col-12 col-md-12"><div class="text-justify">Как новаяКак новаяКак новаяКак новаяКак новаяКак новаяКак новаяКак новаяКак новаяКак новаяКак новаяКак новаяКак новаяКак новаяКак новаяКак новаяКак новаяКак новаяКак новаяКак новая</div></div>
            <div class="row align-items-center">
                <div class="col-6 col-md-5 mt-3 mt-md-3 ">
                    <div class="h5 text">Цена:</div>
                    <div class="h5 text">55 000₽</div>
                </div>
                <div class="col-6 col-md-7  mt-md-3">
                    <div class="form_button ">
                        <button type="button" class="submitbutton" id="buttondetailpagebuy">Купить</button>
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-6 col-md-5 mt-md-3 mt-3">
                    <div class="row">
                        <div class="text">Автор:</div>
                        <div class="text">Александр Ремизов</div>
                    </div>
                </div>
                <div class="col-6 col-md-7 mt-md-3 mt-3">
                    <div class="form_button">
                        <button type="button" class="submitbutton" id="buttondetailpagesubmit">Следить</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-12 mt-3"><div class="text">Дата публикации: 30 февраля 2021</div></div>
    </div>
</div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>