<?php
include("lib/fun.php");
$_POST = json_decode(file_get_contents('php://input'), true);
if(isset($_POST['data'])){
    $data = $_POST['data'];
    $token = getName(25);
    $pin = getPIN();
    $pass = md5($data['password']);
    $sql ="insert into user values('$data[username]','$data[email]','$pass','$token','$pin')";
    // print_r($data);
    $con = connect();
    try{
        $con->query($sql);
        echo "ok";
    }
    catch(Exception $e){
        echo "bad! $e";
    }

}
// print_r($_POST);

?>