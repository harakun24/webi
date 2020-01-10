<?php
include_once "../lib/db.php";
session_start();
class visitor extends Table
{
    public function getNewId()
    {
        $res = $this->select("id")->order("id", "desc")->limit(1)->exec()->fetch();
        return "$_SESSION[user]_" . (explode("_", $res[0]['id'])[1] + 1);
    }
    public function parseID($id)
    {
        return "$_SESSION[user]_" . $id;
    }
}

