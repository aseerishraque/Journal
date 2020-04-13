<?php

include_once('../../vendor/autoload.php');
session_start();
use App\Entry;
use App\Utilities;
use App\User;
use App\Share;
$d = new Utilities();

//$d->dd($_POST);

if (isset($_POST['update']))
{
    $userdb = new User();
    $r = $userdb->updateUser($_POST);
    if($r){
        $_SESSION['success'] = "User Info Updated!";
        header('Location: ../all_users.php');
    }
}else{
    $_SESSION['warning'] = "404 Not Found!!!";
    header('Location: ../all_users.php');
}


