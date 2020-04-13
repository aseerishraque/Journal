<?php
include_once('../../vendor/autoload.php');
session_start();
use App\Entry;
use App\Utilities;
use App\User;
use App\Share;
$d = new Utilities();

if($_GET['user_id'])
{
    $userdb = new User();
    $delete = $userdb->deleteUser($_GET['user_id']);
    if($delete)
    {
        $_SESSION['success']="User Deleted!";
        header('Location: ../all_users.php');
    }
}else
{
    $_SESSION['warning'] = '404 Error';
    header('Location: ../all_users.php');
}