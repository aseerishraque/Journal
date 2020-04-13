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
if (!isset($_SESSION['pass_verify']))
    header('Location: ../login.php');

if(isset($_POST['update_pass']))
{
        if ($_POST['new_pass'] == $_POST['repass'])
        {
            $len = strlen($_POST['new_pass']);
            if ($len >= 8)
            {
                $userdb = new User();
                $r = $userdb->setAdminPassword($_POST['new_pass']);
                if ($r)
                {
                    unset($_SESSION['pass_verify']);

                    $_SESSION['success'] = 'Password Changed Successfully!';

                    header('location: ../login.php');
                }else{
                    $_SESSION['error'] = 'Something went Wrong, Contact Developer!';
                    header('location: ../login.php');
                }
            }else{
                $_SESSION['warning'] = 'New Password Must be at least 8 Characters!';
                header('location: ../new_password.php');
            }

        }else{
            $_SESSION['warning'] = 'New Password Mismatch!';
            header('location: ../new_password.php');
        }

}