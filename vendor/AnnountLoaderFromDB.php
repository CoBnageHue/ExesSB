<?php

require '..\cfg\DBconnection.php';

function getAnn($db):array{
    $prep = $db->prepare("SELECT * FROM announcement");
    $prep->execute();
    if ($prep->rowCount() > 0) return $prep->fetchAll();
    else return [];
}

echo json_encode(getAnn($db));