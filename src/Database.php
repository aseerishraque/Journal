<?php
/**
 * Created by PhpStorm.
 * User: PHP
 * Date: 7/4/2019
 * Time: 2:47 PM
 */
namespace App;

use App\MysqlDb;
use PDO;


class Database
{

    public $server_mail = 'info@aseerishraque.easytechbd.com';




     private $host="localhost";
     private $user="root";
     private $db="journal";
     private $pass="";


//   private $host="184.164.80.26";
//   private $user="easytechbd_journal";
//   private $db="easytechbd_journal";
//   private $pass="j5b&&eW26RyV";



//    private $host="localhost";
//    private $user="id11985952_journal_user1";
//    private $db="id11985952_journal";
//    private $pass="%JmI*szJWnveurzeStC6";


//NameCheap-->

//    private $host="server139.web-hosting.com";
//    private $user="halazdez_admin";
//    private $db="halazdez_journal";
//    private $pass=".{,MH#M^{x4G";


    public $conn;

    public function __construct(){

        $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->db,$this->user,$this->pass);
    }

    public function showData($table){

        $sql="SELECT * FROM $table ORDER BY id DESC";
        $q = $this->conn->query($sql) or die("failed!");

        while($r = $q->fetch(PDO::FETCH_ASSOC)){
            $data[]=$r;
        }
        return $data;
    }

    public function getById($id,$table){

        $sql="SELECT * FROM $table WHERE id = :id";
        $q = $this->conn->prepare($sql);
        $q->execute(array(':id'=>$id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        if ($q->rowCount() == 1)
             return $data;
        else
            return false;
    }



    public function deleteData($id,$table){

        $sql="DELETE FROM $table WHERE id=:id";
        $q = $this->conn->prepare($sql);
        $q->execute(array(':id'=>$id));
        return true;
    }

    public function serverDateTime()
    {
        $data = date("Y-m-d h:i:s", time()) ;

        return $data;
    }

    public function countRows($table)
    {
        $sql = "SELECT COUNT(id) as id FROM $table";
        $q = $this->conn->prepare($sql);
        $q->execute();
        while ($r = $q->fetch(PDO::FETCH_ASSOC))
        {
            $data = $r['id'];
        }
        return $data;
    }

    public function export()
    {
        $dbbackup = new MysqlDb();
        $dbbackup->connect($this->host,$this->user,$this->pass,$this->db);
        $dbbackup->backup();
        date_default_timezone_set("Asia/Dhaka");
        $downloaded_filename = $this->db."_".date("d_m_Y_H_i");
        $dbbackup->download($downloaded_filename);
        return true;
    }

    public function importdb($file_location)
    {
        $dbbackup = new MysqlDb();
        $dbbackup->connect($this->host,$this->user,$this->pass,$this->db);
        $dbbackup->backup();
        $dbbackup->import($file_location);
        return true;
    }


}
