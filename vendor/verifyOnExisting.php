<?php

require '..\cfg\DBconnection.php';


function nameVerify($name):string{
    $pattern = "/^(?!-)(?!\s)(?!.*-$)(?!.*\s$)(?!.*--)(?!.*- )(?!.* -)(?!.*\s\s)[а-яёеА-ЯЁЕ\s-]{1,}+$/i";
    if(preg_match($pattern,$name)){
        return "1";
    }
    else {
        return "0";
    }
}

function emailVerify($mail):string{
    $pattern = "/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,}$/i";
    if(preg_match($pattern,$mail)){
            return "1";
    }
    else {
        return "0";
    }
}

function phoneVerify($phone):string{
    $pattern = "/(\+7|8)[- _]*\(?[- _]*(\d{3}[- _]*\)?([- _]*\d){7}|\d\d[- _]*\d\d[- _]*\)?([- _]*\d){6})/";
    if(preg_match($pattern,$phone)){
        return "1";
    }
    else {
        return "0";
    }
}

function passVerify($pass):string{
    $pattern = "/^(?!\d+$)(?!-+$)(?!\/+$)(?!\.+$)[a-zA-Z0-9.\-\/]{6,}+$/";
    if(preg_match($pattern,$pass)){
        return "1";
    }
    else {
        return "0";
    }
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

$username = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['pass'];

try {
    $array = array(array(Emailcheck($email, $db), Phonecheck($phone, $db)),
        array(nameVerify($username), emailVerify($email), phoneVerify($phone), passVerify($password)));

    echo json_encode($array);
}
catch (PDOException $e) {
    print "Has errors: " . $e->getMessage();  die();
}

