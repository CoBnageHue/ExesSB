<?php
include '..\..\cfg\DBconnection.php';

function getUserInfo($id, $db):array{
    $prep = $db->prepare("SELECT `name`, `email`, `phone`, `reg_date`, `last_visit`, 
       `success_deals`, `success_sells` FROM user where `id_user` = :id_u");
    $prep->bindParam(':id_u', $id);
    $prep->execute();
    if ($prep->rowCount() > 0) return $prep->fetch();
    else return [];
}

function getUserAnn($id, $db):array{
    $prep = $db->prepare("SELECT `name_item`,`price`,`picture`,`publication_time` FROM `announcement` as `a` 
    INNER JOIN `user_announcement` as `ua` on `ua`.`id_announcement` = `a`.`id_announcement` 
    INNER JOIN `user` as `u` on `u`.`id_user` = `ua`.`id_user` WHERE `u`.`id_user` = :id_u");

    $prep->bindParam(':id_u', $id);
    $prep->execute();
    if ($prep->rowCount() > 0) return $prep->fetchAll();
    else return [];
}

session_start();

if ($_SESSION['user']) {

    $UserAnn = getUserAnn($_SESSION['user']['id'],$db);
    $UserInfo = getUserInfo($_SESSION['user']['id'],$db);
}