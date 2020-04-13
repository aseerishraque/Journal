<?php
session_start();
include_once('../../vendor/autoload.php');

use App\Entry;
use App\Share;
use App\Utilities;
use App\Item;
use App\User;
use App\EntryLog;
use App\MultiEntry;

$d = new Utilities();
$obj = new Entry();

if (isset($_POST['proceed']))
{
    $getTotalBalance = $obj->getTotalBalance();

//    $d->dd($_POST);



    $data = $_POST;

    //Checking whether share is available or not For Capital Withdrawn
    if ($_POST['item_id'] == 5)
    {

        $userSHares = new Share();
        $userSHares = $userSHares->shareAmount($_POST['user_id']);

        if ($_POST['share'] <= $userSHares)
            $shareAvailable = 1;
        else
            $shareAvailable = 0;

        if ($shareAvailable == 0)
        {
            $_SESSION['error'] = "Entry Unsuccessful!";
            $_SESSION['warning'] = "Insufficient Shares!";
            header('Location:../new_entry.php');
        }
    }



    if ($_POST['item_id'] == 3) //Profit Withdrawn
        {
            if ($_POST['dr_cr'] <= $_POST['current_profit'])
                $profit_to_withdrawOK = 1;
            else
                $profit_to_withdrawOK = 0;

            if ($profit_to_withdrawOK == 1)
                $r = $obj->store($data);     //Storing in Entries (for Profit Withdrawn)
            else
            {
                $_SESSION['error'] = "Sorry! You do not have that much of Profit!";
                header('Location:../new_entry.php');
            }

        }
    elseif ($_POST['item_id'] == 5) //Capital Withdrawn (Double Entry)
        {
              if ($shareAvailable == 1)
              {
                  $data['date'] = $_POST['date'];
                  $data['item_id'] = 3; //Profit Withdrawn
                  $data['user_id'] = $_POST['user_id'];
                  $data['dr_cr'] = $_POST['current_profit_per_share'];
                  $r = $obj->store($data);     //Storing Profit Withdrawn in Entries
                  $profit_withdrawn_entry_id = $obj->getLastID();



                  $data['date'] = $_POST['date'];
                  $data['item_id'] = $_POST['item_id']; //Capital Withdrawn
                  $data['user_id'] = $_POST['user_id'];
                  $data['dr_cr'] = $_POST['current_value_per_share'];
                  $r = $obj->store($data);     //Storing Capital Withdrawn in Entries
                  $capital_withdrawn_entry_id = $obj->getLastID();

              }
        }
    else
         $r = $obj->store($data);     //Storing in Entries




    if(isset($_POST['item_id']) && $_POST['item_id'] !=0 ){
        if(isset($_POST['share'])){          //Storing in Shares
            $item_id = $data['item_id'];
            $item = new Item();
            $item = $item->getById($item_id, $item->table);
            $share_info = $item['share_info'];

            $obj = new Share();

            if ($share_info == 1)
                $r = $obj->store($_POST);
            elseif ($share_info == 2 && $shareAvailable == 1)
                $r = $obj->withdrawShare($data['share'], $data['user_id']);

        }
        extract($data);


        if(!isset($user_id))   //Profit Or Loss entryLogs
        {
            $item = new Item();
            $itemName = $item->getById($item_id, $item->table);

            $share = new Share();
            $totalShare = $share->totalShare();

            $entry = new Entry();
            $lastId = $entry->getLastID();
            $shareUsers = $share->allShares();
//        $allUsers = $userdb->showData($userdb->table);

            foreach ($shareUsers as $user)
            {
                $data['entry_id'] = $lastId;
                $data['date'] = $date;
                $data['user_id'] = $user['user_id'];
                $data['itemType'] = $itemName['name'];

                if ($item_id == 4) //Profit
                {
                    $data['amount'] = $dr_cr/$totalShare;
                    $data['total_shares'] = $share->shareAmount($user['user_id']);
                }
                elseif ($item_id == 2) //Loss
                {
                    $userdb = new User();

                    echo "loss=".$dr_cr." total=".$getTotalBalance." user_bal=".$userdb->getBalance($data['user_id'])."<br>";
                    $data['amount'] = ($dr_cr / $getTotalBalance ) * $userdb->getBalance($data['user_id']);
                    $data['total_shares'] = 0;

                }


                $entryLog = new EntryLog();
                $r = $entryLog->store($data);

            }

        }

        if($_POST['item_id'] == 1) //Capital entryLogs
        {
            $item = new Item();
            $itemName = $item->getById($item_id, $item->table);

            $entry = new Entry();
            $lastId = $entry->getLastID();

            $data['entry_id'] = $lastId;
            $data['date'] = $date;
            $data['user_id'] = $user_id;
            $data['itemType'] = $itemName['name'];
            $data['amount'] = $dr_cr;
            $data['total_shares'] = $share;
            $entryLog = new EntryLog();
            $r = $entryLog->store($data);

        }
        elseif ($_POST['item_id'] == 5) //Capital Withdrawn (Double Entrylogs)
        {
            //Profit Withdrawn storing in entrylogs
            $item = new Item();
            $itemName = $item->getById(3, $item->table);


            $data['entry_id'] = $profit_withdrawn_entry_id;
            $data['date'] = $date;
            $data['user_id'] = $user_id;
            $data['itemType'] = $itemName['name'];
            $data['amount'] = $_POST['current_profit_per_share'] * $_POST['share'];
            $data['total_shares'] = 0;
            $entryLog = new EntryLog();
            $r = $entryLog->store($data);


            //Capital Withdrawn storing in entrylogs
            $item = new Item();
            $itemName = $item->getById($item_id, $item->table);

            $data['entry_id'] = $capital_withdrawn_entry_id;
            $data['date'] = $date;
            $data['user_id'] = $user_id;
            $data['itemType'] = $itemName['name'];
            $data['amount'] = $_POST['current_value_per_share'];
            $data['total_shares'] = $share;
            $entryLog = new EntryLog();
            $r = $entryLog->store($data);

        }
        elseif ($_POST['item_id'] == 3 && $profit_to_withdrawOK == 1) //Profit Withdrawn entrlogs
        {
            $item = new Item();
            $itemName = $item->getById($item_id, $item->table);

            $entry = new Entry();
            $lastId = $entry->getLastID();

            $data['entry_id'] = $lastId;
            $data['date'] = $date;
            $data['user_id'] = $user_id;
            $data['itemType'] = $itemName['name'];
            $data['amount'] = $dr_cr;
            $data['total_shares'] = 0;
            $entryLog = new EntryLog();
            $r = $entryLog->store($data);


        }

        if ($_POST['item_id'] == 5) //Storing in Multi Entries Capital Withdrawn and Profit Withdrawn
        {


            $multi_entries = new MultiEntry();
            $multi_entry_id = $multi_entries->newMultiEntryId();

            // Storing Profit Withdrawn in Multi Entries
            $data['multi_entry_id'] = $multi_entry_id;
            $data['entry_id'] = $profit_withdrawn_entry_id;
            $multi_entries->store($data);

            // Storing Capital Withdrawn in Multi Entries
            $data['multi_entry_id'] = $multi_entry_id;
            $data['entry_id'] = $capital_withdrawn_entry_id;
            $multi_entries->store($data);

        }
        elseif ($_POST['item_id'] == 3) //Storing in Multi Entries for Profit Withdrawn
        {
            $multi_entries = new MultiEntry();
            $multi_entry_id = $multi_entries->newMultiEntryId();


            // Storing Profit Withdrawn in Multi Entries
            $data['multi_entry_id'] = $multi_entry_id;
            $data['entry_id'] = $lastId;                 //lastId from Entrlogs
            $multi_entries->store($data);
        }

        if($r){
            $_SESSION['success'] = "Entry Successful!";
            header('Location:../tables.php');  //Redirecting to Leisure Table
        }
    }
    else
    {
        $_SESSION['warning'] = "Information Missing!";
        header('Location:../new_entry.php');
    }
}else
{
    $_SESSION['error'] = "404 Not Found!";
    header('Location:../index.php');
}


