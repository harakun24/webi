<?php
include "../model/buku.php";
$baru = new buku();
if (isset($_GET['count'])) {
    echo $baru->getCount();
} else {
    $tmp = [];
    $baru->
        select("buku.kode", "buku.judul", "kategori.nama as kategori", "penerbit.nama as penerbit", "penulis.nama as penulis", "buku.stok")
        ->join("kategori", "kategori", "id")
        ->join("penerbit", "penerbit", "id")
        ->join("penulis", "penulis", "id")
        ->order("buku.kode")->exec();
    while ($row = $baru->fetch()) {
        array_push($tmp, $row);
    }
    echo json_encode($tmp[0]);
}
