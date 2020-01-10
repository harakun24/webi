<?php
include_once "../lib/db.php";
session_start();
class karyawan extends Table
{
    public function getNewId()
    {
        $temp = $this->select("id")
            ->order("id", "desc")
            ->limit(1)->exec()->fetch();
        $temp = $temp[0]['id'];
        $res = explode("_", $temp);
        return $_SESSION['user'] . "_" . ($res[1] + 1);
    }
}
