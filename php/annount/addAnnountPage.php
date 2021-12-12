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
                            <?php
                            include '../nav.php';
                            echo $NavBar;
                            ?>
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
                               <input type="file" accept=".png, .jpg, .jpeg" class="form_pic" id="ann_pic">
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
<script src="../../js/AnnountAddLogic.js"></script>
</html>