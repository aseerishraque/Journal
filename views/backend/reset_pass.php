<?php
include_once('../../vendor/autoload.php');
session_start();
use App\Entry;
use App\Utilities;
use App\User;
use App\Share;
use App\Transfer;

$d = new Utilities();

//$d->dd($_POST);

if(isset($_POST['update_pass']))
{
    $userdb = new User();

        if ($_POST['new_pass'] == $_POST['repass'])
        {
            $len = strlen($_POST['new_pass']);
            if ($len >= 8)
            {
                $r = $userdb->setPassword($_POST['user_id'], $_POST['new_pass']);
                if ($r)
                {
                    $_SESSION['success'] = 'Password Changed Successfully!';
                    header('Location: ../user_info.php?userid='.$_POST['user_id']);
                }else{
                    $_SESSION['error'] = 'Something went Wrong, Contact Developer!';
                    header('Location: ../reset_password.php?user_id='.$_POST['user_id']);
                }
            }else{
                $_SESSION['warning'] = 'New Password Must be at least 8 Characters!';
                header('Location: ../reset_password.php?user_id='.$_POST['user_id']);
            }

        }else{
            $_SESSION['warning'] = 'New Password Mismatch!';
            header('Location: ../reset_password.php?user_id='.$_POST['user_id']);
        }

}else{
    $_SESSION['error'] = '404 Not Found!';
    header('Location: ../login.php');
}