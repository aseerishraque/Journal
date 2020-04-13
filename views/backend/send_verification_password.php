<?php

include_once('../../vendor/autoload.php');
session_start();

use App\Email;
use App\Utilities;

$d = new Utilities();

if (isset($_GET['send']))
{
    $mail = new Email();
    $validMail = $mail->getById(1, 'admin');
    $validMail = $validMail['email_verified'];

    if ($validMail == 1)
    {
        $token = rand(123123,999999);
        $admin_mail = $mail->getById(1, 'admin');
        $admin_mail = $admin_mail['email'];
        $r = $mail->sendVerficationMail($admin_mail, $token);
        if ($r)
        {
            $_SESSION['info'] = "Verification Mail is Sent!";
            header('Location: ../forgot-password.php');
        }
        else
        {
            $_SESSION['error'] = "Verification Mail is Not Sent!";
            header('Location: ../forgot-password.php?error=1');
        }
    }else{
        $_SESSION['error'] = "Admin Mail Not Verified!";
        header('Location: ../forgot-password.php');
    }
}else{
    $_SESSION['error'] = "404 Not found!";
    header('Location: ../login.php');
}