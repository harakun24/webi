<?php
include "../model/buku.php";
include "../model/kategori.php";
include "../model/ven.php";
$baru = new buku();
$kat = new kategori();
$shu = new penerbit();
$sak = new penulis();

if (isset($_GET['count'])) {
    echo $baru->getCount();
} else if (isset($_GET['top'])) {
    $tmp = $kat->top($_GET['top']);
    echo json_encode($tmp);
} else if (isset($_GET['cat'])) {
    $tmp = $kat->selectAll()->exec()->fetch();
    echo json_encode($tmp);

} else if (isset($_GET['shu'])) {
    $tmp = $shu->selectAll()->exec()->fetch();
    echo json_encode($tmp);

} else if (isset($_GET['sakka'])) {
    $tmp = $sak->selectAll()->exec()->fetch();
    echo json_encode($tmp);

} else if (isset($_GET['list'])) {
    $tmp = $baru->selectAll()->exec()->fetch();
    echo json_encode($tmp);

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
