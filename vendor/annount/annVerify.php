<?php
function pic_Verify($pic):string{
    $mime = $pic["type"];
    $ext = pathinfo($pic["name"])["extension"];
    $flag_mime = "0";
    $flag_ext = "0";
    $whitelist_mime = array("image/jpg","image/jpeg","image/pjpeg","image/png","image/x-png");
    $whitelist_ext = array("jpeg","jpg","png");
    if(in_array($mime, $whitelist_mime)) $flag_mime = "1";

    print_r($flag_mime);

    if(in_array($ext, $whitelist_ext)) $flag_ext = "1";

    print_r($flag_ext);

    if($flag_ext == "1" && $flag_mime == "1") return "1";
    else return  "0";
}

function price_Verify($price):string{
    $pattern = "/^([1-9].*[,\\.][0-9]*)$/";
    if(preg_match($pattern,$price)) return "1";
    return "0";
}

$price = $_POST['price'];
$pic = $_FILES['pic'];


echo json_encode(array(price_Verify($price), pic_Verify($pic)));


