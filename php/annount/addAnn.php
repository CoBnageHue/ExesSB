<?php
include '..\..\cfg\DBconnection.php';
function pic_Verify($pic):array{
    $tmp_error = array();
    $error = array();
    if($pic){
        $name = $pic['tmp_name'];
        $mime = strtolower($pic["type"]);
        $ext = strtolower(pathinfo($pic["name"])["extension"]);
        $whitelist_mime = array("image/jpg","image/jpeg","image/pjpeg","image/png","image/x-png");
        $whitelist_ext = array("jpeg","jpg","png");
        if(!in_array($mime, $whitelist_mime)) $tmp_error['mime'] = 'MIME-тип файла не соответствует картинке.';
        if(!in_array($ext, $whitelist_ext)) $tmp_error['ext'] = 'Раширение файла не соответствует картинке.';
        if(!$tmp_error['ext']){
            $test = array();
            if($ext == 'jpeg' || $ext == 'jpg'){
                $test['img'] = @imagecreatefromjpeg($name);
            }
            if($ext == 'png'){
                $test['img'] = @imagecreatefrompng($name);
            }
            if(!$test["img"]){
                $error['non-image'] = 'Вы загрузили не изображение.';
            }
        }
    } else {
        $error['non-exist'] = 'Вы ничего не загрузили';
    }
    return $error;
}

function price_Verify($price):array{
    $error = array();
    $pattern = "/^(?!\.)(?!.*\.$)[0-9]*(?:\.[0-9]*)?$/";
    if(!preg_match($pattern,$price) || !(strlen($price)>0)) $error['format'] = 'Эта строчка не является форматом цены.';
    return $error;
}

function addAnnount($name, $pic, $price, $desc, $db, $id){
    $pathInfo = pathinfo($pic['name']);
    $ext = $pathInfo['extension'] ?? "";
    $file_name = uniqid() . "." . $ext;
    $upload_dir = "../../img/uploads/" . $file_name;

    move_uploaded_file($_FILES['pic']['tmp_name'], $upload_dir);

    $prep1 = $db->prepare("INSERT INTO announcement (`name_item`, `picture`, `price`, `description`)
	    VALUES(:name, :pic, :price, :desc)");

    $prep1->bindParam(':name', $name);
    $prep1->bindParam(':pic', $file_name);
    $prep1->bindParam(':price', $price);
    $prep1->bindParam(':desc', $desc);
    $prep1->execute();


    $prep2 = $db->prepare("SELECT id_announcement FROM announcement WHERE `picture` = :pic");
    $prep2->bindParam(':pic', $file_name);
    $prep2->execute();
    $pr2id = $prep2->fetch();



    $prep3 = $db->prepare("INSERT INTO user_announcement (`id_user`, `id_announcement`) VALUES (:id_u,:id_a)");
    $prep3->bindParam(':id_u', $id);
    $prep3->bindParam(':id_a', $pr2id['id_announcement']);
    $prep3->execute();
}


session_start();
$id = $_SESSION['user']['id'];
$name = htmlspecialchars($_POST['name']);
$price = htmlspecialchars($_POST['price']);
$desc = htmlspecialchars($_POST['desc']);
$pic = $_FILES['pic'];


$error = array();

$error["pic"] = pic_Verify($pic);
$error["price"] = price_Verify($price);

if(count($error["pic"]) == 0 && count($error["price"]) == 0){
    addAnnount($name,$pic,$price,$desc,$db,$id);
}

echo json_encode($error);


