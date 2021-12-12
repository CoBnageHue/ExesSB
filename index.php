<?php
session_start();
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
            <?php
            include 'php/nav.php';
            echo $NavBar;
            ?>
    </div>
</header>

<section class="main" id="main">
    <div class="container">
        <div class="order" id="order">
            <h1 class="maintext">Exchange. Sell. Buy.</h1>
            <br>
            <h2 class="mainsubtext">Удобный сервис для заработка, продажи и предоставления услуг.</h2>
        </div>
    </div>
</section>

<section class="annout" id="annout">
    <div class="container">
            <h1 class="annouttext">Объявления</h1>
        <div class="annoutblock" id="annoutblock">

        </div>
        <div class="show-more-container">
            <button class="show-more">Показать ещё</button>
        </div>
    </div>
</section>
    <footer class="footer" id="footer">
        <h1 class="footertext">Сайт разработан Александром Ремизовым и Евгением Гришагиным.</h1>
    </footer>
</div>

<?php
if(!$_SESSION['user']){
echo '
<div class="reg" id="reg">
    <a href="#" class="poparea pop-up-close"></a>
    <div class="reg_body">
        <div class="reg_content">
            <a href="#" class="close pop-up-close">X</a>
            <form id="reg_form">
                <h1 class="formtitle">Регистрация</h1>
                <div class="form_item">
                    <input type="text" name="name" class="form_bar" id="regnamebar" required>
                    <label class="formlabel">Имя</label>
                    <ul class="regnamebartext">
                      
                    </ul>
                </div>
                <div class="form_item">
                    <input type="text" name="mail"  class="form_bar" id="regmailebar" required>
                    <label class="formlabel">E-mail</label>
                    <ul class="regmailebartext">
                       
                    </ul>
                </div>
                <div class="form_item">
                    <input type="text" name="phone" class="form_bar" id="regphonebar" required>
                    <label class="formlabel">Телефон</label>
                    <ul class="regphonebartext">
                     
                    </ul>
                </div>
                <div class="form_item"> 
                    <input type="password" name="pass" class="form_bar" id="regpassbar" required>
                    <label class="formlabel">Пароль</label>
                    <ul class="regpassbartext">
                       
                    </ul>
                </div>
                <div class="form_item">
                    <input type="password" name="verpass" class="form_bar" id="regverpassbar" required>
                    <label class="formlabel">Повторите пароль</label>
                    <ul class="regverpassbartext">
                        
                    </ul>
                </div>
                <div class="form_item">
                    <input type="checkbox" name="agreement" class="reg_checkbox" id="regcheckbox" checked>
                    <label for="regcheckbox" id="arglabel" class="agrlabel"><p>Соглашаюсь на обработку персональных данных в соответсвии c
                        <a href="#">условиями</a>.</p>
                    </label>
                </div>
                <div class="form_button">
                    <button type="button" class="submitbutton" id="submitreg">Зарегистрироваться</button>
                </div>
                <div class="popup_log" id="log_popup_link">
                    <p>Уже есть аккаунт? <a href="#log" class="pop-up-close">Войти.</a></p>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="log" id="log">
    <a href="#" class="poparea pop-up-close"></a>
    <div class="log_body">
        <div class="log_content">
            <a href="#" class="close pop-up-close">X</a>
            <form id="log_form">
                <h1 class="formtitle">Вход</h1>
                <div class="form_item">
                    <input type="text" name="mail" class="form_bar" id="logmailebar">
                    <label class="formlabel">E-mail</label>
                </div>
                <div class="form_item">
                    <input type="password" name="pass" class="form_bar" id="logpassbar">
                    <label for="logpassbar" class="formlabel">Пароль</label>
                </div>
                <div class="form_button">
                    <button type="button" class="submitbutton" id="submitlog">Войти</button>
                </div>
                <p id="errorsting">Неверная комбинация почта-пароль</p>
            </form>
            <div class="popup_log" id="reg_popup_link">
                <p>Ещё нет аккаунта? <a href="#reg" class="pop-up-close">Зарегистрироваться.</a></p>
            </div>
        </div>
    </div>
</div>
';
}
?>

</body>
<?php if(!$_SESSION['user']){ echo '<script src="/js/RegAndLogLogic.js"></script>';} ?>
<script src="/js/AnnountLoader.js"></script>
</html>
