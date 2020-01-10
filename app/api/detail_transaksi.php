<?php
error_reporting(0);
$_POST = json_decode(file_get_contents('php://input'), true);

include_once "../model/transaksi.php";
$baru=new detail_pinjam();
if(isset($_POST)){
    $temp=$baru->insert()->col("id_pinjam","kode_buku","jumlah")
    ->val($_POST['id'],$_POST['buku'],$_POST['qty'])->exec();
    echo json_encode($temp);
}