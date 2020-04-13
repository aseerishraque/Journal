<?php

include_once('../../vendor/autoload.php');
session_start();

use App\Utilities;
use App\Email;
$d = new Utilities();

//$d->dd($_POST);

if (isset($_POST['verify']))
{
    $mail = new Email();
    $r = $mail->verifyAdminMail($_POST['code_mail']);
    if ($r)
    {
        $_SESSION['success'] = "Email Verified!";
        header("Location: ../settings.php");
    }
    else
    {
        $_SESSION['error'] = "Email Cannot be verified!";
        header("Location: ../settings.php");
    }

}else
{
    $_SESSION['error'] = "404 Not Found!";
    header('Location: ../login.php');
}