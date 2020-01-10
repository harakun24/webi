<?php
include_once "../lib/db.php";
session_start();
class peminjaman extends Table
{
    public function getData()
    {
        return $this
            ->select('karyawan.nama as karyawan',
                'tanggal_pinjam as tanggal', 'buku.judul as buku',
                'visitor.nama as pengunjung')
            ->join('karyawan')->on("id", "karyawan")
            ->join('detail_pinjam')->on("id_pinjam", "id")
            ->join('buku')->on("buku.kode", "detail_pinjam.kode_buku", false)
            ->join('visitor')->on('id', 'visitor')
            ->exec()->fetch();
    }
    public function getID()
    {
        $res = $this->select("id")->order("tanggal_pinjam", "desc")->limit(1)->exec()->fetch();
        return "p-$_SESSION[user]::" . (explode("::", $res[0]['id'])[1] + 1);
    }
}
class detail_pinjam extends Table
{
}
