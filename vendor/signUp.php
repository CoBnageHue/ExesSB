<?php
require '..\cfg\DBconnection.php';

$username = $_POST['name'];
$email = $_POST['mail'];
$phone = $_POST['phone'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$api_token = $_POST['name'].'_'.date("Y-m-d_H:i:s");


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
        "name" => $username,
        "email" => $email,
        "phone" => $phone,
        "token" => $api_token
    ];

} catch (PDOException $e) {
    print "Has errors: " . $e->getMessage();  die();
}
header('Location: ../index.php#log');