<?php

include_once('../../vendor/autoload.php');
session_start();

use App\Email;
use App\Utilities;

$d = new Utilities();

if (isset($_POST['send_verification']))
{
    $token = rand(123123,999999);


    $mail = new Email();
    $r = $mail->sendVerficationMail($_POST['email'], $token);

    if ($r)
    {
        $_SESSION['info'] = "Verification Mail is Sent!";
        header('Location: ../settings.php');
    }
    else
    {
        $_SESSION['error'] = "Verification Mail is Not Sent!";
        header('Location: ../settings.php');
    }


}else{
    $_SESSION['error'] = "404 Not found!";
    header('Location: ../login.php');
}