<?php
include("lib/fun.php");
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
else{
    echo "refuse";
}

?>