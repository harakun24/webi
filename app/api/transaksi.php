<?php
error_reporting(0);

include_once "../model/transaksi.php";
include_once "../model/visitor.php";
$baru = new peminjaman();
$v = new visitor();
if (isset($_GET['list'])) {
    $baru->select("count(*) as c,tanggal_pinjam as tgl")
        ->group("tgl")
        ->exec();

    echo json_encode($baru->fetch());
} else if (isset($_GET['data'])) {
    $temp = $baru->getData();
    echo json_encode($temp);
} else if (isset($_GET['newid'])) {
    $temp = $baru->getID();
    echo json_encode($temp);
} else if (isset($_GET['cek'])) {
    $temp = $v->select("count(*) as c")
        ->where("id", $_GET['cek'])->exec()->fetch();
    $temp = $temp[0]['c'];
    if ($temp == 1) {
        echo json_encode("ok");
    } else if ($temp == 0) {
        echo json_encode("null");
    }

}
