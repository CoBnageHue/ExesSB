<?php

require '..\..\cfg\DBconnection.php';

$email = htmlspecialchars($_POST['email']);
$pass = htmlspecialchars($_POST['pass']);
function mailCheck($mail, $db):array{
        $prep = $db->prepare("SELECT * FROM User WHERE `email` = :email");
        $prep->bindParam(':email', $mail);
        $prep->execute();
        if ($prep->rowCount() > 0) return $prep->fetch();
        else return [];
}
try{
    $error = array();
    if(mailCheck($email, $db) == NULL){
        $error['non-mail'] = 'Такой почты не существует.';
    }
    elseif (password_verify($pass, mailCheck($email, $db)['password'])) {
        session_start();
        $_SESSION['user'] = [
            "id" => mailCheck($email, $db)['id_user'],
            "name" => mailCheck($email, $db)['name'],
            "email" => mailCheck($email, $db)['email'],
            "phone" => mailCheck($email, $db)['phone'],
            "token" => mailCheck($email, $db)['token']
        ];
    } else {
        $error['non-pass'] = 'Неверный пароль.';
    }
    json_encode($error);

} catch (PDOException $e) {
    print "Has errors: " . $e->getMessage();  die();
}
