<?php
session_start();

if (isset($_GET['user'])) {
    include "../model/user.php";
    $user = new user($_GET['user']);
    $_SESSION['user'] = $user->username;
    // if($user->getStatus()=="y"){
    //     header("Location: http://webi.com/dashboard");
    // }
    // else{
    //     header("Location: http://webi.com/konfirmasi");
    // }
    header("Location: http://webi.com/dashboard");
}
else{
    header("Location: http://webi.com/login");
}
