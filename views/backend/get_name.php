<?php


include_once('../../vendor/autoload.php');

use App\User;
use App\Entry;
$entry = new Entry();
$obj = new User();
if(isset($_GET['user_id']) && $_GET['user_id'] !="")
{
    $name = $obj->getById($_GET['user_id'], $obj->table);
    $shares = $obj->getUserShareQuantity($_GET['user_id']);
    $balance = $obj->getBalance($_GET['user_id']);
    $current_value_per_share = $entry->current_value_per_share($_GET['user_id']);
    $current_profit = $entry->current_profit($_GET['user_id']);
    $current_profit_per_share = $entry->current_profit_per_share($_GET['user_id']);
    if($name!=false){
        $json_arr = array(
            "name" => $name['name'],
            "balance" => $balance,
            "shares" => $shares,
            "current_value_per_share" => $current_value_per_share,
            "current_profit" => $current_profit,
            "current_profit_per_share" => $current_profit_per_share
        );
        $data_json = json_encode($json_arr);
        echo $data_json;
    }
    else
        echo false;
}
else
    echo false;
