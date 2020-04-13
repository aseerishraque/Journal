<?php
include_once('../../vendor/autoload.php');
session_start();
use App\Entry;
use App\Utilities;
use App\User;
use App\Share;
//$d = new Utilities();
//
//$d->dd($_POST);


$userdb = new User();

if($_POST['register']){
    if($_POST['pass'] == $_POST['repass'])
    {
        $checkUsername = $userdb->usernameExist($_POST['username']);
        if($checkUsername)
            $r = $userdb->register($_POST);
        else
        {
            $_SESSION['warning']="Username Already taken!";
            if (isset($_GET['admin'])){
                header("Location: ../new_user.php");
            }
            else
            {
                header("Location: ../register.php");
            }

        }

    }else{
        $_SESSION['warning']="Password Mismatch!";
        if (isset($_GET['admin'])){
            header("Location: ../new_user.php");
        }
        else{
            header("Location: ../register.php");
        }

    }

    if($r){
        $_SESSION['success'] = "User Registered Successfully!!";
        if (isset($_GET['admin'])){
            header("Location: ../all_user.php");
        }
        else{
            header("Location: ../login.php");
        }

    }

}



