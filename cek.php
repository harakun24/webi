<?php
include("lib/fun.php");
$_POST = json_decode(file_get_contents('php://input'), true);

$con = connect();
if(isset($_GET['token'])){
   $query = "select code from user where token='$_GET[token]'";
   $rest=$con->query($query);
   if($rest->num_rows>0){
       $row = $rest->fetch_assoc();
       echo $row['code'];
   }
   else{
       echo "null";
   }
}
else if(isset($_GET['uname'])){
    $query = "select code from user where username='$_GET[uname]'";
    $rest=$con->query($query);
    if($rest->num_rows>0){
        echo "exist!";
    }
    else{
        echo "ok";
    }
}
else if(isset($_GET['cek'])){
    $query = "select code from user where email='$_GET[cek]'";
    $rest=$con->query($query);
    if($rest->num_rows>0){
        echo "exist!";
    }
    else{
        echo "ok";
    }
}
else if(isset($_GET['clogin'])){
    $query = "select code from user where username='$_GET[clogin]'";
    $rest=$con->query($query);
    if(!$rest->num_rows>0){
        echo json_encode("exist!");
    }
    else{
        echo json_encode("ok");
    }
}
else if(isset($_POST['log'])){
    $data=$_POST['log'];
    $pass=md5($data['pass']);
    $query = "select code from user where username='$data[user]' and password='$pass'";
    $rest=$con->query($query);
    if(!$rest->num_rows>0){
        echo json_encode("exist!");
    }
    else{
        echo json_encode("ok");
    }
}
else{
    echo json_encode("refuse");
}

?>