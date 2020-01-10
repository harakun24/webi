<?php
error_reporting(0);
$_POST = json_decode(file_get_contents('php://input'), true);

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
}
else if(isset($_GET['count'])){
    $temp=$baru->select("count(*) as c")->exec()->fetch();
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
else if(isset($_POST))
{
    $id=$baru->getID();
    $date=date("Y-m-d");
    $temp=$baru->insert()->col("id","karyawan","tanggal_pinjam","estimasi","visitor","status")
    ->val($id,$_POST['karyawan'],$date,7,$_POST['visitor'],0)->exec()->result;
    echo json_encode($temp);
    // echo json_encode($baru->sql);
}
else if(isset($_GET['aktif'])){
    $temp=$baru->select('id')->where("karyawan",$_GET['karyawan'])
    ->where("tanggal_pinjam",date("Y-m-d"))->where("visitor",$_GET['visitor'])
    ->exec()->fetch();
    echo json_encode($temp);
}
