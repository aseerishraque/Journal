<?php
include_once('../../../vendor/autoload.php');
session_start();
use App\User;
use App\Utilities;
$obj = new User();
$d = new Utilities();
extract($_POST);
//$d->dd($_POST);


if (isset($_POST['login'])){
    $data = $obj->login($username, $PASS);
    if ($data)
    {
        $_SESSION['user_type'] = $data['user_type'];
        $_SESSION['user_id'] = $data['id'];



        if ($data['user_type'] == 'user')
        {
            $_SESSION['name'] = $data['name'];
            $_SESSION['success'] = 'Welcome, '.$data['name'];
            header('Location: ../../user-dashboard.php');
        }
        elseif($data['user_type'] == 'admin')
        {
            $_SESSION['success'] = 'Welcome Admin';
            header('Location: ../../index.php');
        }

    }
    else{
        $_SESSION['error'] = "Wrong Username Or Password.";
        header('Location: ../../login.php');
    }
}else
{
    $_SESSION['error'] = "404 Error!";
    header('Location: ../../login.php');
}


