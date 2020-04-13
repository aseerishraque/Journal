<?php

include_once('../../vendor/autoload.php');
session_start();
use App\Entry;
use App\Utilities;
use App\User;
use App\Share;
use App\MultiEntry;

$d = new Utilities();

$entrydb = new Entry();

if(isset($_GET['entry_id']))
{
    $multi_entries = new MultiEntry();
    $item_id = $entrydb->getItemIdByEntryId($_GET['entry_id']);

    if ($item_id == 5 || $item_id ==3)
    {
        $multi_entries_arr = $multi_entries->getMultiEntriesByEntryId($_GET['entry_id']);
        $r = $multi_entries->deleteMultiEntries($multi_entries_arr);
    }
    else
    {
        $r = $entrydb->deleteEntry($_GET['entry_id']);
    }

    if($r)
    {
        $_SESSION['success'] = 'Entry Deleted!';
        header('Location: ../tables.php');
    }
    else
    {
        $_SESSION['error'] = "Share Already Sold!";
        $_SESSION['info'] = "Please Undo Transaction!";
        header('Location: ../tables.php');
    }
}
else
{
    $_SESSION['warning'] = "404 Not Found!";
    header('Location: ../tables.php');
}
