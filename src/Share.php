<?php


namespace App;

use App\Utilities;
use PDO;


class Share extends Database
{
    public $table = "shares";

    public function store($data)
    {
        extract($data);
        $sql = "SELECT * FROM shares WHERE user_id = $user_id";
        $q = $this->conn->prepare($sql);
        $r = $q->execute();
        $hasShare = $q->rowCount();
        if($hasShare)
        {
            $sql = "UPDATE shares SET quantity = quantity + $share WHERE user_id = $user_id";
            $q = $this->conn->prepare($sql);
            $r = $q->execute();
            if($r)
                return true;
            else
                return false;
        }
        else
        {
            $sql = "INSERT INTO shares SET user_id = $user_id, quantity = $share";
            $q = $this->conn->prepare($sql);
            $r = $q->execute();
            if($r)
                return true;
            else
                return false;
        }


    }

    public function totalShare()
    {
        $sql = "SELECT SUM(quantity) as amount FROM shares";
        $q = $this->conn->prepare($sql);
        $r = $q->execute();
        $r = $q->fetch(PDO::FETCH_ASSOC);
        if ($q->rowCount() > 0 )
        {
            if (is_null($r['amount']))
                return 0;
            else
                return $r['amount'];
        }
        else
            return 0;
    }

    public function shareAmount($user_id)
    {
        $sql = "SELECT quantity FROM shares WHERE user_id = $user_id";
        $q = $this->conn->prepare($sql);
        $r = $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        if($data > 0)
            return $data['quantity'];
        else
            return 0;
    }

    public function withdrawShare($amount, $user_id)
    {
        $sql = "UPDATE shares SET quantity = quantity - $amount WHERE user_id = $user_id";
        $q = $this->conn->prepare($sql);
        $r = $q->execute();

        $sql = "DELETE FROM shares WHERE quantity = 0";  //DELETE Zero share accounts
        $q = $this->conn->prepare($sql);
        $r = $q->execute();
        if($r)
            return true;
        else
            return false;
    }

    public function allShares()
    {
        $sql = "SELECT * FROM shares WHERE quantity > 0";
        $q = $this->conn->prepare($sql);
        $r = $q->execute();
        if ($q->rowCount() > 0)
        {
            while ($row = $q->fetch(PDO::FETCH_ASSOC))
            {
                $data[] = $row;
            }
            return $data;
        }
        else
            return $data = array();
    }

    public function totalShares()
    {

    }

}