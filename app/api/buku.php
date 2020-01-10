<?php
$_POST = json_decode(file_get_contents('php://input'), true);
session_start();
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
    if (isset($_SESSION['user'])) {
        if ($_GET['list'] == "stok") {
            $tmp = $baru->select("kode", "kategori.nama as kategori", "judul", "penerbit"
                , "penulis", "stok")->join("kategori")->on("id", "kategori")
                ->where("user", $_SESSION['user'])
                ->order($_GET['list'], "desc")->exec()->fetch();

        } else {
            $tmp = $baru->select("kode", "kategori.nama as kategori", "judul", "penerbit"
                , "penulis", "stok")->join("kategori")->on("id", "kategori")
                ->where("user", $_SESSION['user'])
                ->order($_GET['list'])->exec()->fetch();

        }

        echo json_encode($tmp);
    } else {
        echo json_encode("refuse");
    }

} else if (isset($_GET['cari'])) {
    if (isset($_SESSION['user'])) {
        
            $tmp = $baru->select("kode", "kategori.nama as kategori", "judul", "penerbit"
                , "penulis", "stok")->join("kategori")->on("id", "kategori")
                ->where("user", $_SESSION['user'])
                ->where("judul", $_GET['cari'], "yes")
                ->order("judul", "desc")->exec()->fetch();

        
            

        

        echo json_encode($tmp);
    } else {
        echo json_encode("refuse");
    }

} else if (isset($_GET['cek'])) {
    $tmp = $baru->selectAll()->where('kode', $_GET['cek'])->exec()->fetch();
    if ($baru->result->num_rows > 0) {
        echo json_encode($tmp);
    } else {
        echo json_encode("null");
    }

} else if (isset($_POST['data'])) {
    $_POST['data']['user'] = $_SESSION['user'];
    $data = $_POST['data'];
    if ($data['status'] == "add") {
        $baru->select("count(*) as c")
            ->where("judul", $data['judul'])
            ->where("user", $data['user'])
            ->exec();
        $r = $baru->fetch();
        if ($r[0]['c'] > 0) {
            echo json_encode("exist!");
        } else {
            $baru->insert()->col("user", "kategori", "judul", "penerbit", "penulis", "stok")
                ->val($data['user'], $data['kategori'], $data['judul'], $data['penerbit'], $data['penulis'], $data['stok'])->exec();
            echo json_encode($baru->result);
        }
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
        $baru->delete()->where("kode", $data['kode'])->exec();
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
