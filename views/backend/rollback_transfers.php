<?php

include_once('../../vendor/autoload.php');
session_start();
use App\Entry;
use App\Utilities;
use App\User;
use App\Share;
use App\Transfer;

if(isset($_GET['trxID']))
{
    $rollback = new Transfer();
    $rollback = $rollback->rollBackTransferShare($_GET['trxID']);
    if($rollback)
    {
        $_SESSION['success'] = "Transaction Successfully Undone!";
        header("Location: ../transfers.php");
    }
    else
    {
        $_SESSION['error'] = "Transaction Cannot Be Undone!";
        header("Location: ../transfers.php");
    }
}
else
{
    $_SESSION['warning'] = "Unauthorized!";
    header("Location: ../index.php");
}
