<?php
session_start();
include "../model/user.php";
include("../lib/mail.php");

$user = new user($_GET['user']);
$_SESSION['code']=$user->Code();
Mail::Send("dimasoppo448@gmail.com","baru","kode anda: <b>$_SESSION[code]</b> <br>klik link berikut untuk mengkonfirmasi: http://webi.com/plogin?user=$_SESSION[user]","console.log('hai')");

include "../resource/email.html";
