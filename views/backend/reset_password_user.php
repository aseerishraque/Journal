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
    $oldPassDB = $userdb->getOldPasswordByUserID($_POST['user_id']);

    if ($oldPassDB == $_POST['old_pass'])
        $old_OK = 1;
    else
        $old_OK = 0;
    if ($old_OK == 1)
    {
        if ($_POST['new_pass'] == $_POST['repass'])
        {
            $len = strlen($_POST['new_pass']);
            if ($len >= 8)
            {
                $r = $userdb->setPassword($_POST['user_id'], $_POST['new_pass']);
                if ($r)
                {
                    $_SESSION['success'] = 'Password Changed Successfully!';
                    header('Location: ../user-dashboard.php');
                }else{
                    $_SESSION['error'] = 'Something went Wrong, Contact Developer!';
                    header('Location: ../user-dashboard.php');
                }
            }else{
                $_SESSION['warning'] = 'New Password Must be at least 8 Characters!';
                header('Location: ../reset_password_user.php');
            }

        }else{
            $_SESSION['warning'] = 'New Password Mismatch!';
            header('Location: ../reset_password_user.php');
        }
    }else{
        $_SESSION['warning'] = 'Old Password Mismatch!';
        header('Location: ../reset_password_user.php');
    }
}