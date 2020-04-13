<?php

include_once('../../vendor/autoload.php');
session_start();
use App\Entry;
use App\Utilities;
use App\User;
use App\Share;
use App\Transfer;

$d = new Utilities();

if (isset($_POST['update_email']))
{
    $user = new User();
    $r = $user->setAdminEmail($_POST['email']);
    if ($r)
    {
        $_SESSION['success'] = "Email Updated Successfully!";
        header('Location: ../settings.php');
    }else{
        $_SESSION['error'] = "Something went wrong!";
        header('Location: ../settings.php');
    }
}
else{
    $_SESSION['error'] = "404 Not Found!";
    header('Location: ../index.php');
}