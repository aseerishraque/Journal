<?php
session_start();
include_once('../../vendor/autoload.php');

use App\Utilities;
use App\User;
use App\Transfer;
$d = new Utilities();

//$d->dd($_POST);
if (isset($_POST['transferShare']))
{

    extract($_POST);
    if ($seller_id == $buyer_id && isset($seller_id) && isset($buyer_id)){
        $_SESSION['warning'] = 'Seller Or Buyer Cannot Be Same';
        header('Location: ../share_transfer.php');
    }elseif ($seller_id == "" || $buyer_id == ""){
        $_SESSION['warning'] = 'Information Missing !!!';
        header('Location: ../share_transfer.php');
    }
    else
    {
        $user = new Transfer();
        $user = $user->transferShare($_POST);

        if($user)
        {
            $_SESSION['success'] = "Transaction Successful";
            header('Location: ../share_transfer.php');
        }
        else{
            $_SESSION['error'] = "Transaction Failed!";
            header('Location: ../share_transfer.php');
        }
    }

}
else
{
    $_SESSION['error'] = "404 Not Found!";
    header('Location: ../share_transfer.php');
}
