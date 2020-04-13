<?php


namespace App;


use PDO;
use App\Utilities;
use App\Share;

class Entry extends Database
{

    public $table = "entries";

    public function userForm($itemId)
    {
         $sql = "SELECT user_form FROM items WHERE id = :itemId";

        $q = $this->conn->prepare($sql);
        $q->execute(array(':itemId' => $itemId));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        return $data['user_form'];

    }

    public function shareForm($itemId)
    {
        $sql = "SELECT share_info FROM items WHERE id = :itemId";

        $q = $this->conn->prepare($sql);
        $q->execute(array(':itemId' => $itemId));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        return $data['share_info'];

    }


    public function store($data)
    {
        extract($data);

        $sql = "SELECT dr_cr FROM items WHERE id=$item_id";

        $q = $this->conn->prepare($sql);
        $q->execute();
        $row = $q->fetch(PDO::FETCH_ASSOC);
   $dr_cr_str = $row['dr_cr'];

        if(!isset($user_id))
            $user_id = 0;
        if(isset($share))
            $dr_cr = $dr_cr*$share;

 $sql = "INSERT INTO entries SET date = '$date',
                                            item_id=$item_id,
                                         user_id = $user_id,
                                         $dr_cr_str = $dr_cr";

        $q = $this->conn->prepare($sql);
        $r = $q->execute();

        if($r)
            return true;
        else
            return false;
    }


    public function showJournal()
    {
        $sql="SELECT e.id, date, (SELECT name FROM items WHERE id = e.item_id) AS item, user_id, ( SELECT name FROM users WHERE id = e.user_id) as name, debit, credit FROM entries e ORDER BY id asc;";
        $q = $this->conn->query($sql) or die("failed!");

        if($q->rowCount() > 0){
            while($r = $q->fetch(PDO::FETCH_ASSOC)){
                $data[]=$r;
            }
        }
        else
            $data = 0;
        return $data;
    }

    public function getLastID() // After entry stored in entries
    {
        $sql = "SELECT id FROM entries ORDER BY id DESC LIMIT 0,1";
        $q = $this->conn->prepare($sql);
        $q->execute();
        $r = $q->fetch(PDO::FETCH_ASSOC);
        if (isset($r))
            $entry_id = $r['id'];
        else
            $entry_id = 1;
        return $entry_id;
    }

    public function showUserJournal($user_id)
    {
       $sql = "SELECT e.date,
(SELECT name FROM items WHERE id = e.item_id) as item,
IF(e.item_id = 2, l.amount, e.debit) as debit,
IF(e.item_id = 4 , l.amount * l.total_shares, e.credit) as credit
FROM entries e LEFT JOIN entrylogs l on e.id = l.entry_id WHERE l.user_id = $user_id ORDER BY e.id asc";
        $q = $this->conn->query($sql) or die("failed!");

        if($q->rowCount() > 0){
            $i = 0;
            while($r = $q->fetch(PDO::FETCH_ASSOC))
            {
                $data[] = $r;
            }
        }
        else
            $data = array();
        $data2 = $this->getUserTransfers($user_id);
        $result = array_merge($data, $data2);

        return $result;
    }


    public function getUserTransfers($user_id)
    {
        $sql = "SELECT id, date, itemType as item, user_id,

(SELECT name FROM users WHERE id = e.user_id) as name
, 
 IF(itemType = 'Sell' || itemType = 'Sells of Profit', 
    
  (amount*total_shares)  , 0 ) as debit
, 
 IF(itemType = 'Buy' || itemType = 'Purchase of Profit', 
    
 (amount*total_shares), 0 ) as credit
  
FROM transfers e WHERE user_id = $user_id ORDER BY id ASC";

        $q = $this->conn->prepare($sql);
        $q->execute();

        if ($q->rowCount() > 0)
        {
            while ($row = $q->fetch(PDO::FETCH_ASSOC))
            {
                if ($row['item'] == 'Sell')
                    $row['item'] = 'Sales of Shares';
                elseif ($row['item'] == 'Buy')
                    $row['item'] = 'Purchase of Shares';
                $data[] = $row;
            }

            return $data;
        }else
            return $data=array();

    }

    public function getTotalBalance()
    {
        $sql = "SELECT (SUM(credit) - SUM(debit)) as balance FROM entries";
        $q = $this->conn->prepare($sql);
        $q->execute();
        $r = $q->fetch(PDO::FETCH_ASSOC);

        if ($r){
            $r = $r['balance'];
            return $r;
        }else
            return 0;
    }

    public function deleteEntry($entry_id)
    {
        $data = $this->getById($entry_id, $this->table);

        extract($data);
        if ($item_id == 1 || $item_id == 5) //Capital Or Capital Withdrawn
        {
            $sql = "SELECT * FROM entrylogs WHERE entry_id = $entry_id";
            $q = $this->conn->prepare($sql);
            $q->execute();
            $data = $q->fetch(PDO::FETCH_ASSOC);

            $entryShare = $data['total_shares'];

                $sharedb = new Share();

                if ($item_id == 1) //Capital
                {
                    if($entryShare <= $sharedb->shareAmount($data['user_id']))
                        {

                      $withdrawShare = $sharedb->withdrawShare($entryShare, $data['user_id']);  // Withdrawing Shares
                        if ($withdrawShare)
                            $SharesRollbackOK = 1;
                        else
                            $SharesRollbackOK = 0;
                    }else
                        return false;
                }
                elseif ($item_id == 5) //Capital Withdrawn
                {
                    $shareData['user_id'] = $data['user_id'];
                    $shareData['share'] = $entryShare;
                    $addShare = $sharedb->store($shareData);
                    if ($addShare)
                        $SharesRollbackOK = 1;
                    else
                        $SharesRollbackOK = 0;
                }

                if ($SharesRollbackOK == 1)
                {
                    $sql = "DELETE FROM entries WHERE id = $entry_id"; //DELETING Entries information
                    $q = $this->conn->prepare($sql);
                    $r = $q->execute();

                    if ($r)
                        $DeleteEntriesOK = 1;
                    else
                        $DeleteEntriesOK = 0;

                    if ($DeleteEntriesOK == 1)
                    {
                        $sql = "DELETE FROM entrylogs WHERE entry_id = $entry_id";  //DELETING Log information
                        $q = $this->conn->prepare($sql);
                        $r = $q->execute();

                        if ($r)
                            return true;
                        else
                            return false;
                    }
                    else
                        return false;
                }
                else
                {
                    return false;
                }

        }
        elseif ($item_id == 2 || $item_id == 4 || $item_id == 3 ) // Loss,Profit, Profit Withdrawn
        {
            $sql = "DELETE FROM entries WHERE id = $entry_id"; //DELETING Entries information
            $q = $this->conn->prepare($sql);
            $r = $q->execute();

            if ($r)
                $DeleteEntriesOK = 1;
            else
                $DeleteEntriesOK = 0;

            if ($DeleteEntriesOK == 1)
            {
                $sql = "DELETE FROM entrylogs WHERE entry_id = $entry_id";  //DELETING Log information
                $q = $this->conn->prepare($sql);
                $r = $q->execute();

                if ($r)
                    return true;
                else
                    return false;
            }
            else
                return false;
        }
        else
        {
            return false;
        }
    }

    public function totalByItem($item_id)
    {
        $sql = "SELECT (SUM(credit) - SUM(debit)) as amount FROM entries WHERE item_id = $item_id";
        $q = $this->conn->prepare($sql);
        $r = $q->execute();
        if ($q->rowCount() > 0)
        {
            $r = $q->fetch(PDO::FETCH_ASSOC);
            if ($r['amount'] < 0)
              return $r['amount']*(-1);
            elseif(is_null($r))
                return 0;
            else
              return $r['amount'];
        }
        else
            return 0;

    }

    public function current_value_per_share($user_id)
    {
        $sql = "SELECT SUM(-IF(e.item_id = 2, l.amount, e.debit)+IF(e.item_id = 4 , l.amount * l.total_shares, e.credit)) as amount 
FROM entries e LEFT JOIN entrylogs l on e.id = l.entry_id 
WHERE item_id!=3 AND item_id!=4 and l.user_id = $user_id ORDER BY e.id asc";
        $q = $this->conn->prepare($sql);
        $r = $q->execute();
        $r = $q->fetch(PDO::FETCH_ASSOC);
        if (isset($r['amount']))
            $amount = $r['amount'];
        else
            $amount = 0;


        $sql = "SELECT SUM(-IF(itemType = 'Sell', (amount*total_shares)  , 0 )+IF(itemType = 'Buy', (amount*total_shares), 0 )) as balance
FROM transfers e WHERE user_id = $user_id";
        $q = $this->conn->prepare($sql);
        $r = $q->execute();
        $r = $q->fetch(PDO::FETCH_ASSOC);
        if (isset($r['balance']))
            $tbalance = $r['balance'];
        else
            $tbalance = 0;
        $amount +=$tbalance;

        $sql = "SELECT quantity FROM shares WHERE user_id = $user_id";
        $q = $this->conn->prepare($sql);
        $r = $q->execute();
        $r = $q->fetch(PDO::FETCH_ASSOC);
        if (isset($r['quantity']))
            $shares = $r['quantity'];
        else
            $shares = 0;

        if ($amount != 0)
        $amount /= $shares;

        $number = $amount;
        $precision = 3;
        $amount = number_format((float) $number, $precision, '.', '');

        return $amount;

    }

    public function current_profit($user_id)
    {
        $sql = "SELECT SUM(-IF(e.item_id = 2, l.amount, e.debit)+IF(e.item_id = 4 , l.amount * l.total_shares, e.credit)) as amount 
FROM entries e LEFT JOIN entrylogs l on e.id = l.entry_id 
WHERE (item_id=3 OR item_id=4) AND l.user_id = $user_id ORDER BY e.id asc";
        $q = $this->conn->prepare($sql);
        $r = $q->execute();
        $r = $q->fetch(PDO::FETCH_ASSOC);
        if (isset($r['amount']))
            $amount = $r['amount'];
        else
            $amount = 0;

        $sql = "SELECT SUM(-IF(itemType = 'Sells of Profit', (amount*total_shares)  , 0 )+IF(itemType = 'Purchase of Profit', (amount*total_shares), 0 )) as balance
FROM transfers e WHERE user_id = $user_id";
        $q = $this->conn->prepare($sql);
        $r = $q->execute();
        $r = $q->fetch(PDO::FETCH_ASSOC);
        if (isset($r['balance']))
            $tbalance = $r['balance'];
        else
            $tbalance = 0;

        $amount +=$tbalance;

        $number = $amount;
        $precision = 3;
        $amount = number_format((float) $number, $precision, '.', '');

        return $amount;

    }


    public function current_profit_per_share($user_id)
    {
        $amount = $this->current_profit($user_id);
        $shares = new Share();
        $shares = $shares->shareAmount($user_id);
        if ($amount != 0)
        $amount /= $shares;
        $a = new Utilities();
        $amount = $a->setPrecision($amount, 3);
        return $amount;
    }

    public function getItemIdByEntryId($entry_id)
    {
        $data = $this->getById($entry_id, $this->table);
        $item_id = $data['item_id'];
        return $item_id;
    }

    public function current_profit_of_company()
    {
        $sql = "SELECT SUM(-IF(e.item_id = 2, l.amount, e.debit)+IF(e.item_id = 4 , l.amount * l.total_shares, e.credit)) as amount FROM entries e LEFT JOIN entrylogs l on e.id = l.entry_id 
WHERE item_id=3 OR item_id=4";
        $q = $this->conn->prepare($sql);
        $r = $q->execute();
        $r = $q->fetch(PDO::FETCH_ASSOC);
        if (isset($r['amount']))
            return $r['amount'];
        else
            return 0;

    }

    public function getEntryUserIds()
    {
        $sql = "SELECT DISTINCT user_id FROM entrylogs ORDER by user_id asc";
        $q = $this->conn->prepare($sql);
        $r = $q->execute();
        if ($q->rowCount() > 0)
            while ($row = $q->fetch(PDO::FETCH_ASSOC))
                $data1[] = $row['user_id'];
        else
            $data1 = array();

        $sql = "SELECT DISTINCT user_id FROM transfers ORDER by user_id asc";
        $q = $this->conn->prepare($sql);
        $r = $q->execute();
        if ($q->rowCount() > 0)
            while ($row = $q->fetch(PDO::FETCH_ASSOC))
                $data2[] = $row['user_id'];
        else
            $data2 = array();
        $data = array_merge($data1, $data2);
        $data = array_unique($data);
        return $data;
    }


}