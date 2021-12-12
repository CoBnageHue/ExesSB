<?php
if ($_SESSION['user']) {
    $NavBar = '
        <div class="nav">
            <div class="logo">
                <img src="/img/mainicon.png" alt="logo" class="logopic">
                <p class="logotext">ExSB</p>
            </div>
            <div class="menu_block" id = "menu_block" >
                <ul class="menu" id = "menu" >
                    <li >
                        <a href = "/index.php" class="menu_obj_text" id="mainlink" >Главная</a >
                    </li >
                    <li >
                        <a href = "/php/profile/profile.php" class="menu_obj_text" id="profilelink" >Профиль</a >
                    </li >
                    <li >
                        <a href = "/php/annount/addAnnountPage.php" class="menu_obj_text" id="addAnnount" >Добавить объявление</a >
                    </li >
                    <li >
                        <a href = "#findAnnount" class="menu_obj_text" id="findAnnount" >Найти объявление</a >
                    </li >
                    <li >
                        <a href = "/php/exit.php" class="menu_obj_text" id="exit" >Выйти</a >
                    </li >
                </ul >
                 <a class="burger" id="burger">
                    <span></span>
                 <p class="menu_text">Меню</p>
                </a>
            </div>
        </div>
            <script src="../../js/BurgerLogic.js"></script>';
} else {
    $NavBar = '
        <div class="nav">
            <div class="logo">
                <img src="/img/mainicon.png" alt="logo" class="logopic">
                <p class="logotext">ExSB</p>
            </div>
            <div class="menu_block" id = "menu_block" >
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
                </ul >
                <a class="burger" id="burger">
                    <span></span>
                    <p class="menu_text">Меню</p>
                </a>
            </div>
        </div>
            <script src="../../js/BurgerLogic.js"></script>';
}
