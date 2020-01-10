<?php
session_start();
if (isset($_SESSION['user'])) {
    header("Location: plogin?user=$_SESSION[user]");
}

$base = "http://webi.com/";
include "../resource/login.html";
