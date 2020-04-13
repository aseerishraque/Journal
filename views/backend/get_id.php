<?php


include_once('../../vendor/autoload.php');

use App\User;

$obj = new User();
if (isset($_GET['user_name'])) {
    $id = $obj->getByName($_GET['user_name'], $obj->table);
    if (isset($id))
        echo $id['id'];
    else
        echo false;
}
