<?php
include "../lib/db.php";
session_start();
class buku extends Table
{
    public $id;
    public $judul;
    public function getCount()
    {
        $tmp = $this->select("count(*) as hasil")
            ->exec()->fetch();
        return json_encode($tmp[0]['hasil']);
    }

}
