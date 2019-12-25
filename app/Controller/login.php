<?php
session_start();
if (isset($_SESSION['user'])) {
    header("Location: proses-login.php");
}

$base = "http://webi.com/";
include "../resource/login.html";
