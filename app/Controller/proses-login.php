<?php
session_start();

if (isset($_GET['user'])) {
    include "../model/user.php";
    $user = new user($_GET['user']);
    $_SESSION['user'] = $user->username;
}
header("Location: http://webi.com/dashboard");
