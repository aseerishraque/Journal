<?php

include_once('../../vendor/autoload.php');
session_start();

use App\Utilities;
use App\Email;
$d = new Utilities();

//$d->dd($_POST);

if (isset($_POST['reset_password']))
{
    $mail = new Email();
    $r = $mail->verifyAdminMail($_POST['token']);
    if ($r)
    {
        $_SESSION['pass_verify'] = 1;
        $_SESSION['success'] = 'Enter New Password!';
        header("Location: ../new_password.php");
    }
    else
    {
        $_SESSION['error'] = 'Invalid!';
        header("Location: ../forgot-password.php");
    }

}else
{
    $_SESSION['error'] = "404 Not Found!";
    header('Location: ../login.php');
}
