<?php
function autoloader($classname){
    include_once __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $classname) . '.php';
}
spl_autoload_register('autoloader');
include_once __DIR__ . '/functions.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uploads_dir = __DIR__ . '/images';
    if (!is_dir($uploads_dir)) {
        mkdir($uploads_dir);
    }
    $error = $_FILES["profile"]["error"];
    if($error == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES["profile"]["tmp_name"];
        $extension = pathinfo($_FILES["profile"]["name"], PATHINFO_EXTENSION);
        $new_name = md5(date_create()->format('Unix Timestamp'));
        move_uploaded_file($tmp_name, "$uploads_dir/$new_name.$extension");
        // addUser($login, $password, $email);
    } else {
        echo 'File wasn\`t uploaded!';
    }

    die();
}

include 'router.php';