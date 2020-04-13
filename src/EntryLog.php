<?php


namespace App;


use PDO;
use App\Utilities;
class EntryLog extends Database
{

    public $table = "entrylogs";

    public function store($data)
    {
        extract($data);

        $sql = "INSERT INTO entrylogs SET date = '$date',
                                           user_id = $user_id,
                                           entry_id = $entry_id,
                                           itemType ='$itemType',
                                           amount = $amount,
                                           total_shares = $total_shares";
        $q = $this->conn->prepare($sql);
        $r = $q->execute();

        if($r)
            return true;
        else
            return false;
    }
}