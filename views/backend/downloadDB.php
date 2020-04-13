<?php

include_once('../../vendor/autoload.php');
session_start();
use App\Database;


if (isset($_GET['download']))
{
    $export = new Database();

    $r = $export->export();

    if ($r)
    {
        header('Location: ../settings.php');
    }
    else
    {
        $_SESSION['error'] = "Database Error!";
        header('Location: ../settings.php');
    }
}
else{
    $_SESSION['error'] = "404 Not Found!";
    header('Location: ../settings.php');
}
