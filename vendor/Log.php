<?php

require '..\cfg\DBconnection.php';

$email = $_POST['email'];
$pass = $_POST['pass'];
function mailCheck($mail, $db):array{
        $prep = $db->prepare("SELECT * FROM User WHERE `email` = :email");
        $prep->bindParam(':email', $mail);
        $prep->execute();
        if ($prep->rowCount() > 0) return $prep->fetch();
        else return [];
}
try{
    if(mailCheck($email, $db) == NULL){
        echo json_encode("0");
    }
    elseif (password_verify($pass, mailCheck($email, $db)['password'])) {
        session_start();
        $_SESSION['user'] = [
            "name" => mailCheck($email, $db)['name'],
            "email" => mailCheck($email, $db)['email'],
            "phone" => mailCheck($email, $db)['phone'],
            "token" => mailCheck($email, $db)['token']
        ];
        echo json_encode("1");
    } else {
        echo json_encode("0");
    }
} catch (PDOException $e) {
    print "Has errors: " . $e->getMessage();  die();
}
