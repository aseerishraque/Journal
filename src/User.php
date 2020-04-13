<?php
namespace App;

use PDO;
use App\Utilities;
use App\Share;
use App\Entry;
use App\EntryLog;
class User extends Database
{
    public $table = "users";

    public function getByName($name,$table){

        $sql="SELECT * FROM $table WHERE name = :name";
        $q = $this->conn->prepare($sql);
        $q->execute(array(':name'=>$name));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        return $data;
    }


    public function login($username, $PASS)
    {
        $sql = "SELECT * FROM users WHERE username = '$username' and PASS='$PASS'";
        $q = $this->conn->prepare($sql);
        $q->execute();
        $sql1 = "SELECT * FROM admin WHERE username = '$username' and PASS='$PASS'";
        $q1 = $this->conn->prepare($sql1);
        $q1->execute();
        if($q->rowCount() > 0)
        {
            while ($row = $q->fetch(PDO::FETCH_ASSOC))
            {
                $data = $row;
            }
            $data['user_type'] = 'user';
            return $data;
        }
        elseif($q1->rowCount() > 0 )
        {
            while ($row = $q1->fetch(PDO::FETCH_ASSOC))
            {
                $data = $row;
            }
            $data['user_type'] = "admin";
            return $data;
        }else
            return 0;

    }


    public function userAmount()
    {
        $sql = "SELECT COUNT(*) as amount FROM users";
        $q = $this->conn->prepare($sql);
        $r = $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        if($data > 0)
            return $data['amount'];
        else
            return 0;
    }

    public function getBalance($user_id)
    {
        $sql = "SELECT (SUM(IF((itemType = 'Capital') || (itemType = 'Profit'), amount*total_shares, 0))
 - SUM(IF((itemType = 'Capital Withdrawn'), amount*total_shares,
   IF((itemType = 'loss') || (itemType = 'Profit Withdrawn'), amount, 0)))) as balance
FROM entrylogs WHERE user_id = $user_id";
        $q = $this->conn->prepare($sql);
        $r = $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);

        if (is_null($data['balance']))
            $balance = 0;
        else
            $balance = $data['balance'];




        $sql = "SELECT (SUM(IF((itemType = 'Buy' || itemType = 'Purchase of Profit'), amount*total_shares, 0))
- SUM(IF((itemType = 'Sell' || itemType = 'Sells of Profit'), amount*total_shares,0))) as balance
FROM transfers WHERE user_id = $user_id";
        $q = $this->conn->prepare($sql);
        $r = $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);

        if (is_null($data['balance']))
            $tbalance = 0;
        else
            $tbalance = $data['balance'];

        $balance += $tbalance;
        $balance = number_format((float) $balance, 3, '.', '');

        return $balance;
    }


    public function getUserShareQuantity($user_id)
    {
        $sql = "SELECT quantity FROM shares WHERE user_id = $user_id";
        $q = $this->conn->prepare($sql);
        $r = $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        if($q->rowCount() > 0)
            return $data['quantity'];
        else
            return 0;
    }


    public function userCheck($user_id)
    {
        $r = $this->getById($user_id, $this->table);

        if ($r)
            return true;
        else
            return false;
    }



    public function register($data)
    {
        extract($data);
        $username = strtolower(trim($username));
        $sql = "INSERT INTO users SET username=:username,
                                      name=:name,
                                      email=:email,
                                      pass=:pass,
                                      NID=:NID,
                                      NID_name=:NID_name,
                                      name_bangla=:name_bangla,
                                      gender=:gender,
                                      present_division=:present_division,
                                      present_district=:present_district,
                                      present_address=:present_address,
                                      permanent_division=:permanent_division,
                                      permanent_district=:permanent_district,
                                      permanent_address=:permanent_address,
                                      profession=:profession,
                                      mobile=:mobile,
                                      fb_id=:fb_id,
                                      father_name=:father_name,
                                      father_mobile=:father_mobile,
                                      mother_name=:mother_name,
                                      mother_mobile=:mother_mobile,
                                      spouse_name=:spouse_name,
                                      spouse_mobile=:spouse_mobile,
                                      nominee_name=:nominee_name,
                                      nominee_info=:nominee_info,
                                      nominee_info_details=:nominee_info_details,
                                      bank=:bank,
                                      bank_acc=:bank_acc,
                                      bank_acc_branch=:bank_acc_branch,
                                      bkash=:bkash,
                                      bkash_type=:bkash_type,
                                      rocket=:rocket,
                                      rocket_type=:rocket_type";
        $q = $this->conn->prepare($sql);
        $r = $q->execute(array(
                                     ":username" => $username,
                                      ":name" => $name,
                                      ":email" => $email,
                                      ":pass" => $pass,
                                      ":NID" => $NID,
                                      ":NID_name" => $NID_name,
                                      ":name_bangla" => $name_bangla,
                                      ":gender" => $gender,
                                      ":present_division" => $present_division,
                                      ":present_district" => $present_district,
                                      ":present_address" => $present_address,
                                      ":permanent_division" => $permanent_division,
                                      ":permanent_district" => $permanent_district,
                                      ":permanent_address" => $permanent_address,
                                      ":profession" => $profession,
                                      ":mobile" => $mobile,
                                      ":fb_id" => $fb_id,
                                      ":father_name" => $father_name,
                                      ":father_mobile" => $father_mobile,
                                      ":mother_name" => $mother_name,
                                      ":mother_mobile" => $mother_mobile,
                                      ":spouse_name" => $spouse_name,
                                      ":spouse_mobile" => $spouse_mobile,
                                      ":nominee_name" => $nominee_name,
                                      ":nominee_info" => $nominee_info,
                                      ":nominee_info_details" => $nominee_info_details,
                                      ":bank" => $bank,
                                      ":bank_acc" => $bank_acc,
                                      ":bank_acc_branch" => $bank_acc_branch,
                                      ":bkash" => $bkash,
                                      ":bkash_type" => $bkash_type,
                                      ":rocket" => $rocket,
                                      ":rocket_type" => $rocket_type
        ));
        if($r)
            return true;
        else
            return false;

     }


    public function updateUser($data)
    {
        extract($data);
        $username = strtolower(trim($username));
        $sql = "UPDATE users SET username=:username,
                                      name=:name,
                                      email=:email,
                                      NID=:NID,
                                      NID_name=:NID_name,
                                      name_bangla=:name_bangla,
                                      gender=:gender,
                                      present_division=:present_division,
                                      present_district=:present_district,
                                      present_address=:present_address,
                                      permanent_division=:permanent_division,
                                      permanent_district=:permanent_district,
                                      permanent_address=:permanent_address,
                                      profession=:profession,
                                      mobile=:mobile,
                                      fb_id=:fb_id,
                                      father_name=:father_name,
                                      father_mobile=:father_mobile,
                                      mother_name=:mother_name,
                                      mother_mobile=:mother_mobile,
                                      spouse_name=:spouse_name,
                                      spouse_mobile=:spouse_mobile,
                                      nominee_name=:nominee_name,
                                      nominee_info=:nominee_info,
                                      nominee_info_details=:nominee_info_details,
                                      bank=:bank,
                                      bank_acc=:bank_acc,
                                      bank_acc_branch=:bank_acc_branch,
                                      bkash=:bkash,
                                      bkash_type=:bkash_type,
                                      rocket=:rocket,
                                      rocket_type=:rocket_type WHERE id = $user_id";
        $q = $this->conn->prepare($sql);
        $r = $q->execute(array(
            ":username" => $username,
            ":name" => $name,
            ":email" => $email,
            ":NID" => $NID,
            ":NID_name" => $NID_name,
            ":name_bangla" => $name_bangla,
            ":gender" => $gender,
            ":present_division" => $present_division,
            ":present_district" => $present_district,
            ":present_address" => $present_address,
            ":permanent_division" => $permanent_division,
            ":permanent_district" => $permanent_district,
            ":permanent_address" => $permanent_address,
            ":profession" => $profession,
            ":mobile" => $mobile,
            ":fb_id" => $fb_id,
            ":father_name" => $father_name,
            ":father_mobile" => $father_mobile,
            ":mother_name" => $mother_name,
            ":mother_mobile" => $mother_mobile,
            ":spouse_name" => $spouse_name,
            ":spouse_mobile" => $spouse_mobile,
            ":nominee_name" => $nominee_name,
            ":nominee_info" => $nominee_info,
            ":nominee_info_details" => $nominee_info_details,
            ":bank" => $bank,
            ":bank_acc" => $bank_acc,
            ":bank_acc_branch" => $bank_acc_branch,
            ":bkash" => $bkash,
            ":bkash_type" => $bkash_type,
            ":rocket" => $rocket,
            ":rocket_type" => $rocket_type
        ));
        if($r)
            return true;
        else
            return false;

     }

    public function deleteUser($user_id)
    {
        $sql = "DELETE FROM users WHERE id = $user_id";
        $q = $this->conn->prepare($sql);
        $r = $q->execute();
        if($r)
            return true;
        else
            return false;
     }

    public function totalUsers()
    {
        $sql = "SELECT COUNT(*) as total_users FROM users";
        $q = $this->conn->prepare($sql);
        $r = $q->execute();
        $r = $q->fetch(PDO::FETCH_ASSOC);
        if ($q->rowCount() > 0)
            return $r['total_users'];
        else
            return 0;
     }


    public function getOldPasswordByUserID($user_id)
    {
        $sql = "SELECT pass FROM users WHERE id = $user_id";
        $q = $this->conn->prepare($sql);
        $r = $q->execute();
        $r = $q->fetch(PDO::FETCH_ASSOC);
        if ($q->rowCount() > 0)
            return $r['pass'];
        else
            return false;
     }

    public function setPassword($user_id, $pass)
    {

        $sql = "UPDATE users SET pass = '$pass' WHERE id = $user_id";
        $q = $this->conn->prepare($sql);
        $r = $q->execute();
       if ($r)
            return true;
        else
            return false;

     }


    public function usernameExist($username)
    {
        $username = strtolower(trim($username));
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $q = $this->conn->prepare($sql);
        $r = $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        if (is_null($data['username']))
            return 1;
        else
            return 0;
     }

    public function setAdminPassword($pass)
    {
        $sql = "UPDATE admin SET PASS = '$pass' where username = 'admin'";
        $q = $this->conn->prepare($sql);
        $r = $q->execute();

        if ($r)
            return true;
        else
            return false;
     }

    public function getOldPassOfAdmin()
    {
        $sql = "SELECT * FROM admin WHERE username = 'admin'";
        $q = $this->conn->prepare($sql);
        $r = $q->execute();

        $data = $q->fetch(PDO::FETCH_ASSOC);

        return $data['PASS'];

     }

    public function setAdminEmail($email)
    {
        $sql = "SELECT * FROM admin WHERE id = 1";
        $q = $this->conn->prepare($sql);
        $r = $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
       $old_mail = $data['email'];

       if ($old_mail == $email)
           $verify = $data['email_verified'];
       else
           $verify = 0;


        $sql = "UPDATE admin SET email = '$email', email_verified = $verify WHERE id = 1";
        $q = $this->conn->prepare($sql);
        $r = $q->execute();

        if ($r)
            return true;
        else
            return false;
     }




}