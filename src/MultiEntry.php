<?php


namespace App;
use PDO;
use App\Entry;

class MultiEntry extends Database
{
    public $table = "multi_entries";

    public function newMultiEntryId()
    {
        $sql = "SELECT id from multi_entries ORDER BY id DESC LIMIT 0,1";
        $q = $this->conn->prepare($sql);
        $q->execute();
        $r = $q->fetch(PDO::FETCH_ASSOC);
        if (isset($r))
            $multi_entry_id = $r['id'] + 1;
        else
            $multi_entry_id = 1;

        return $multi_entry_id;
    }

    public function getMultiEntriesByEntryId($entry_id)
    {
        $sql = "SELECT multi_entry_id from multi_entries WHERE entry_id = $entry_id";
        $q = $this->conn->prepare($sql);
        $q->execute();
        $r = $q->fetch(PDO::FETCH_ASSOC);
        $multi_entry_id = $r['multi_entry_id'];


       $sql = "SELECT * FROM multi_entries WHERE multi_entry_id = $multi_entry_id";
        $q = $this->conn->prepare($sql);
        $q->execute();
        if ($q->rowCount() > 0)
        {
            while ($row = $q->fetch(PDO::FETCH_ASSOC))
                $data[] = $row;
        }
        else
            $data = array();
        return $data;
    }


    public function deleteMultiEntries($multi_entries_array)
    {
        foreach ($multi_entries_array as $entry_id)
        {
            $entries = new Entry();
            $r = $entries->deleteEntry($entry_id['entry_id']);
            if ($r == false)
            {
                $entry_delete_OK = 0;
                break;
            }
            else
                $entry_delete_OK = 1;
            $multi_entry_id = $entry_id['multi_entry_id'];
        }

        if ($entry_delete_OK == 1)
        {
            $sql = "DELETE FROM multi_entries WHERE multi_entry_id = $multi_entry_id";
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

    public function store($data)
    {
        extract($data);
        $sql = "INSERT INTO multi_entries SET multi_entry_id = $multi_entry_id, entry_id = $entry_id";
        $q = $this->conn->prepare($sql);
        $r = $q->execute();
        if ($r)
            return true;
        else
            return false;

    }
}