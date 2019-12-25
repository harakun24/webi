<?php
include "../lib/db.php";
session_start();
class kategori extends Table
{
    public function top($count = 1)
    {
        $tmp = $this->select("kategori.nama", "count(*) as jumlah")
            ->join("buku", "id", "kategori")
            ->where("buku.user", $_SESSION['user'])
            ->group("kategori.nama")
            ->order("jumlah", "desc")
            ->limit($count)
            ->exec()->fetch();
        return $tmp;
    }
}
