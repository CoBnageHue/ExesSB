<?php

require '..\..\cfg\DBconnection.php';

function nameVerify($name):array{
    $cyrillic_name = preg_replace("/[a-zA-Z]+$/", '', $name);
    $special_name = preg_replace("/[^а-яёА-ЯЁa-zA-Z\s-]+$/", '', $name);

    $error = array();

    if(strlen($name) != strlen($cyrillic_name))
        $error['cyrillic'] = 'Имя должно быть написано на кириллице.';

    if(strlen($name) != strlen($special_name))
        $error['special'] = 'Разрешённые символы: пробел и дефис.';

    if(!preg_match('/^(?!-)(?!\s)(?!.*-$)(?!.*\s$)/',$name))
        $error['begin-end'] = 'Имя не должно начинаться или заканчиваться специальными символами.';

    if(!preg_match('/^(?!.*--)(?!.*- )(?!.* -)(?!.*\s\s)/',$name))
            $error['double'] = 'Специальные символы не могут идти подряд.';

    if(strlen($name) < 1)
        $error['size'] = 'Длина имени должна быть 1 символ или больше.';


    return $error;
}

function emailVerify($mail,$db):array{
    $error = array();
    $pattern = "/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,}$/i";
    if(!preg_match($pattern,$mail))
        $error['format'] = 'Формат: адрес@сервис.домен.';
    if(Emailcheck($mail, $db) == 0)
        $error['exist'] = 'Пользователь с такой почтой уже существует.';

    return $error;
}

function phoneVerify($phone,$db):array{
    $error = array();
    $pattern = "/(\+7|8)[- _]*\(?[- _]*(\d{3}[- _]*\)?([- _]*\d){7}|\d\d[- _]*\d\d[- _]*\)?([- _]*\d){6})$/";
    if(!preg_match($pattern,$phone))
        $error['format'] = 'Формат: +7/8-XXX-XXX-XX-XX.';
    if(Phonecheck($phone, $db) == 0)
        $error['exist'] = 'Пользователь с таким телефоном уже существует.';
    return $error;
}

function passVerify($pass):array{
    $error = array();
    $latinic_pass = preg_replace("/[а-яА-Я]+$/", '',$pass);
    $special_pass = preg_replace("/[^\/а-яёА-ЯЁa-zA-Z0-9.-]+$/", '', $pass);
    if(strlen($latinic_pass) != strlen($pass))
        $error['latinic'] = 'Пароль должен быть написан на латинице.';

    if(strlen($special_pass) != strlen($pass))
        $error['special'] = 'Разрешённые символы: цифры, ".","/","-".';

    if(strlen($pass) < 6)
        $error['size'] = 'Длина пароля должна быть 6 символов или больше.';

    if(!preg_match("/^(?!\d+$)(?!-+$)(?!\/+$)(?!\.+$)/",$pass))
        $error['special_all'] = 'Пароль не может состоять только из специальных символов.';

    return $error;
}

function verpassVerify($verpass, $pass):array{
    $error = array();
    if(strcmp($verpass, $pass) !== 0)
        $error['verpass'] = 'Пароли должны совпадать.';

    return $error;
}

function Emailcheck($mail, $db): string{
    $prep = $db->prepare("SELECT count(*) FROM User WHERE `email` = :email");
    $prep->bindParam(':email', $mail);
    $prep->execute();
    $rowEmail = $prep->fetch();
    $countEmail = $rowEmail[0];
    if($countEmail == 0){
        return "1";
    }
    else {
        return "0";
    }
}

function Phonecheck($phone, $db): string{
    $prep = $db->prepare("SELECT count(*) FROM User WHERE `phone` = :phone");
    $prep->bindParam(':phone', $phone);
    $prep->execute();
    $rowPhone = $prep->fetch();
    $countPhone = $rowPhone[0];
    if($countPhone == 0) {
        return "1";
    }
    else {
        return "0";
    }
}

function Registration($username, $email, $phone, $password, $api_token, $db){
    try {
        $prep = $db->prepare("INSERT INTO User (`name`, `email`, `phone`, `password`, `api_token`)
	VALUES(:name, :email, :phone, :password, :api_token)");

        $prep->bindParam(':name', $username);
        $prep->bindParam(':email', $email);
        $prep->bindParam(':phone', $phone);
        $prep->bindParam(':password', $password);
        $prep->bindParam(':api_token', $api_token);
        $prep->execute();


        session_start();
        $_SESSION['user'] = [
            "id" => getUserByEmail($email, $db)['id_user'],
            "name" => getUserByEmail($email, $db)['name'],
            "email" => getUserByEmail($email, $db)['email'],
            "phone" => getUserByEmail($email, $db)['phone'],
            "token" => getUserByEmail($email, $db)['token']
        ];

    } catch (PDOException $e) {
        print "Has errors: " . $e->getMessage();  die();
    }
}

function getUserByEmail($email,$db):array{
    $prep = $db->prepare("SELECT * FROM user WHERE `email` = :email");
    $prep->bindParam(':email', $email);
    $prep->execute();
    if ($prep->rowCount() > 0) return $prep->fetch();
    else return [];
}

$username = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
$phone = htmlspecialchars($_POST['phone']);
$password = htmlspecialchars($_POST['pass']);
$verpass = htmlspecialchars($_POST['verpass']);
$api_token = $_POST['name'].'_'.date("Y-m-d_H:i:s");


$error['name'] = nameVerify($username);
$error['email'] = emailVerify($email, $db);
$error['phone'] = phoneVerify($phone, $db);
$error['pass'] = passVerify($password);
$error['verpass'] = verpassVerify($verpass, $password);

if(count($error['name']) == 0 &&
    count($error['email']) == 0 &&
    count($error['phone']) == 0 &&
    count($error['pass']) == 0 &&
    count($error['verpass']) == 0 ) {
        Registration($username, $email, $phone, $password, $api_token, $db);
    }
echo json_encode($error);



