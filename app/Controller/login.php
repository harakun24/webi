<?php
session_start();
if (isset($_SESSION['user'])) {
    header("Location: plogin");
}

$base = "http://webi.com/";
include "../resource/login.html";
