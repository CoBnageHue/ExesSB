<?php
    session_start();
if(!$_SESSION['user']) {
    header('Location: ../../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/main.css">
    <title>ExSB: Покупай, исполняй</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body>
        <div class="wrapper" id="wrapper">
            <header class="header" id="header">
                <div class="container">
                    <div class="nav">
                        <div class="logo">
                            <img src="../../img/mainicon.png" alt="logo" class="logopic">
                            <p class="logotext">ExSB</p>
                        </div>
                        <div class="menu_block" id="menu_block">
                            <ul class="menu" id = "menu" >
                                <li >
                                    <a href = "../../index.php" class="menu_obj_text" id="mainlink" >Главная</a >
                                </li >
                                <li >
                                    <a href = "#profile" class="menu_obj_text" id="profilelink" >Профиль</a >
                                </li >
                                <li >
                                    <a href = "#" class="menu_obj_text" id="addAnnount" >Добавить объявление</a >
                                </li >
                                <li >
                                    <a href = "#findAnnount" class="menu_obj_text" id="findAnnount" >Найти объявление</a >
                                </li >
                                <li >
                                    <a href = "../exit.php" class="menu_obj_text" id="exit" >Выйти</a >
                                </li >
                            </ul >
                            <a class="burger" id="burger">
                                <span></span>
                                <p class="menu_text">Меню</p>
                            </a>
                        </div>
                    </div>
                </div>
            </header>
            <section class="add_form_section" id="add_form_section">
                <div class="container">
                       <form id="add_form">
                           <h1 class="formtitle">Добавление объявления</h1>
                           <div class="form_item">
                               <input type="text" class="form_bar" id="ann_name">
                               <label class="formlabel">Название услуги/товара для продажи</label>
                           </div>
                           <div class="form_item">
                               <input type="text" class="form_bar" id="ann_price">
                               <label class="formlabel">Цена</label>
                           </div>
                           <div class="form_item">
                               <label class="piclabel">Фото товара</label>
                               <input type="file" accept="image/*" class="form_pic" id="ann_pic">
                           </div>
                           <div class="form_item">
                               <textarea class="form_bar" id="ann_desc"></textarea>
                               <label class="formlabel">Описание</label>
                           </div>
                           <div class="form_button">
                               <button type="button" class="submitbutton" id="submitaddann">Добавить</button>
                           </div>
                       </form>
                </div>
            </section>
        </div>
</body>
<script src="../../js/BurgerLogic.js"></script>
<script src="../../js/AnnountAddLogic.js"></script>
</html>