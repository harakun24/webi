<?php
$_POST = json_decode(file_get_contents('php://input'), true);
include "../model/user.php";
$user = new user();
if (isset($_GET['token'])) {
    $tmp = $user->select("code")->where("token", $_GET['token'])
        ->exec()->fetch();
    echo json_encode($tmp[0]['code']);
} else if (isset($_GET['uname'])) {
    $user->select("code")->where("username", $_GET[uname])->exec();
    if ($user->result->num_rows > 0) {
        echo json_encode("bad");
    } else {
        echo json_encode("ok");
    }

} else if (isset($_GET['cek'])) {
    $user->select("code")->where("email", $_GET['cek'])
        ->exec();
    if ($user->result->num_rows > 0) {
        echo json_encode("bad");
    } else {
        echo json_encode("ok");
    }

} else if (isset($_GET['clogin'])) {
    $user->select("code")->where("username", $_GET['clogin'])
        ->exec();
    if ($user->result->num_rows > 0) {
        echo json_encode("ok");
    } else {
        echo json_encode("bad");
    }

} else if (isset($_POST['log'])) {
    $data = $_POST['log'];
    $pass = md5($data['pass']);
    $user->select("code")->where("username", $data['user'])
        ->where("password", $pass)->exec();
    if (!$user->result->num_rows > 0) {
        echo json_encode("bad");
    } else {
        echo json_encode("ok");
    }

} else if (isset($_POST['data'])) {
    $data = $_POST['data'];
    $token = getRnd(25);
    $pin = getPIN();
    $pass = md5($data['password']);

    try {
        $user->insert()
            ->val($data[username], $data[email], $pass, $token, $pin, 'N')
            ->exec();
        echo json_encode("ok");
    } catch (Exception $e) {
        echo json_encode("bad! $e");
    }

} else if (isset($_GET['k'])&&isset($_GET['u'])) {
    $tmp=$user->select('code')->where("username",$_GET['u'])->exec()->fetch();
    if($_GET['k']==$tmp[0]['code']){
        $user->update()->set("verify","y")
        ->where("username",$_GET['u'])->exec();
        echo json_encode("ok");
    }
    else{
        echo json_encode("bad!");
    }
} else {
    echo json_encode("refuse");
}
