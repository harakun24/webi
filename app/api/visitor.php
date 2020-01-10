<?php
$_POST = json_decode(file_get_contents('php://input'), true);
error_reporting(0);
session_start();
include "../model/visitor.php";
$baru = new visitor();

if (isset($_GET['list'])) {
    if (isset($_SESSION['user'])) {

        $tmp = $baru->selectAll()
            ->order($_GET['list'])->exec()->fetch();

        echo json_encode($tmp);
    } else {
        echo json_encode("refuse");
    }

} else if (isset($_GET['cek'])) {
    $tmp = $baru->selectAll()->where('id', $_GET['cek'])->exec()->fetch();
    if ($baru->result->num_rows > 0) {
        echo json_encode($tmp);
    } else {
        echo json_encode("null");
    }

} 

else if (isset($_POST['data'])) {
    $data = $_POST['data'];
    if ($data['status'] == "add") {
        $temp = $baru->getNewId();
        $baru->insert()->col("id", "nama", "email", "alamat")
            ->val($temp, $data['nama'], $data['email'], $data['alamat'])->exec();
        echo json_encode($baru->result);

    } else if ($_POST['data']['status'] == "edit") {
        $baru->update()
            ->set("judul", $data['judul'])
            ->set("kategori", $data['kategori'])
            ->set("penerbit", $data['penerbit'])
            ->set("penulis", $data['penulis'])
            ->set("stok", $data['stok'])
            ->where("kode", $data['kode'])->exec();
        echo json_encode($baru->result);
    } else if ($_POST['data']['status'] == "delete") {
        $baru->delete()->where("id", $data['id'])->exec();
        echo json_encode($baru->result);
    }
} else {
    // $tmp = [];
    // $baru->
    //     select("buku.kode", "buku.judul", "kategori.nama as kategori", "penerbit.nama as penerbit", "penulis.nama as penulis", "buku.stok")
    //     ->join("kategori", "kategori", "id")
    //     ->join("penerbit", "penerbit", "id")
    //     ->join("penulis", "penulis", "id")
    //     ->order("buku.kode")->exec();
    // while ($row = $baru->fetch()) {
    //     array_push($tmp, $row);
    // }
    // echo json_encode($tmp[0]);
    echo json_encode("refused");
}
