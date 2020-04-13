<?php


namespace App;

use PDO;
use App\Share;
use App\User;

class Transfer extends Database
{
     public $table = "transfers";

    public function store($data)
    {
        extract($data);

        $sql = "INSERT INTO transfers SET date = '$date',
                                           user_id = $user_id,
                                           trxID = $trxID,
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

    public function newTrxID()
    {
        $sql = "SELECT DISTINCT trxID FROM transfers ORDER BY id DESC LIMIT 0,1";
        $q = $this->conn->prepare($sql);
        $r = $q->execute();
        if ($q->rowCount() > 0)
        {
            $r = $q->fetch(PDO::FETCH_ASSOC);
            return $r['trxID']+1;
        }
        else
            return 1;
     }

    public function transferShare($data)
    {
        extract($data);
        $userdb = new User();
        $sellerCheck = $userdb->userCheck($seller_id);

        $buyerCheck = $userdb->userCheck($buyer_id);
        $sellerShares = new Share();
        $sellerShares = $sellerShares->shareAmount($seller_id);

        $newTrxID = $this->newTrxID();

        if($sellerCheck == $buyerCheck && $shares <= $sellerShares)
        {
//    Seller info Storing in Transfers
            $data['itemType']= 'Sells of Profit';
            $data['date'] = $date;
            $data['user_id'] = $seller_id;
            $data['amount'] = $current_profit_per_share;
            $data['trxID'] = $newTrxID;
            $data['total_shares'] = $shares;
            $r = $this->store($data);


//    Seller info Storing in Transfers
            $data['itemType']= 'Sell';
            $data['date'] = $date;
            $data['user_id'] = $seller_id;
            $data['amount'] = $current_value_per_share;
            $data['trxID'] = $newTrxID;
            $data['total_shares'] = $shares;
            $r = $this->store($data);


//    Buyer info Storing in Transfers
            $data['itemType']= 'Purchase of Profit';
            $data['date'] = $date;
            $data['user_id'] = $buyer_id;
            $data['amount'] = $current_profit_per_share;
            $data['trxID'] = $newTrxID;
            $data['total_shares'] = $shares;
            $r = $this->store($data);


//    Buyer info Storing in Transfers
            $data['itemType']= 'Buy';
            $data['date'] = $date;
            $data['user_id'] = $buyer_id;
            $data['amount'] = $current_value_per_share;
            $data['trxID'] = $newTrxID;
            $data['total_shares'] = $shares;
            $r = $this->store($data);

//     Winthdrwing SHares from Seller
            $Share = new Share();
            $Share->withdrawShare($shares, $seller_id);

//        Adding SHares to Buyer
            $data['share'] = $shares;
            $data['user_id'] = $buyer_id;
            $Share->store($data);


            if ($r)
                return true;
            else
                return false;
        }else
            return false;

    }

    public function allTransfers()
    {
        $sql = "SELECT s.trxID, s.date, buyer, seller, s.amount, s.total_shares 
           FROM (SELECT id, trxID, date, 
           (SELECT name FROM users WHERE id = user_id) as seller, amount, total_shares FROM transfers WHERE itemType = 'Sell') s,
            (SELECT trxID, (SELECT name FROM users WHERE id = user_id) as buyer FROM transfers WHERE itemType = 'Buy') b WHERE s.trxID = b.trxID";
        $q = $this->conn->prepare($sql);
        $q->execute();
        if($q->rowCount() > 0)
        {
            while ($row = $q->fetch(PDO::FETCH_ASSOC))
                $data[] = $row;
            return $data;
        }
        else
            return $data = array();
    }


    public function rollBackTransferShare($trxID)
    {
        $sql = "SELECT * FROM transfers WHERE trxID = $trxID AND itemType = 'Sell'";
        $q = $this->conn->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $transferedShare = $data['total_shares'];
        $seller_id = $data['user_id'];

        $sql = "SELECT * FROM transfers WHERE trxID = $trxID AND itemType = 'Buy'";
        $q = $this->conn->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);

        $buyer_id = $data['user_id'];

        $sql = "SELECT * FROM shares WHERE user_id = $seller_id";
        $q = $this->conn->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);

        $sellerShares = $data['quantity'];

        $sql = "SELECT * FROM shares WHERE user_id = $buyer_id";
        $q = $this->conn->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);

        $buyerShares = $data['quantity'];

        $userdb = new User();
        $sellerCheck = $userdb->userCheck($seller_id);
        $buyerCheck = $userdb->userCheck($buyer_id);

        if ($sellerCheck == $buyerCheck && $transferedShare <= $buyerShares )
        {
            $sql = "DELETE FROM transfers WHERE trxID = $trxID";
            $q = $this->conn->prepare($sql);
            $q->execute();

            $sharedb = new Share();
            $withdrawShare = $sharedb->withdrawShare($transferedShare, $buyer_id);

            $data['share'] = $transferedShare;
            $data['user_id'] = $seller_id;
            $addShare = $sharedb->store($data);
            if ($withdrawShare == $addShare)
                return true;
            else
                return false;

        }else
            return false;

    }

    public function totalTransfers()
    {
        $sql = "SELECT COUNT(DISTINCT trxID) as total_transfers FROM transfers";
        $q = $this->conn->prepare($sql);
        $q->execute();
        if ($q->rowCount() > 0)
        {
            $data = $q->fetch(PDO::FETCH_ASSOC);
            return $data['total_transfers'];
        }
        else
            return 0;

    }
}