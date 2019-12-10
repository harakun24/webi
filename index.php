<?php
session_start();
include("lib/fun.php");
$con = connect();


    if(!isset($_SESSION['session_name'])){
        $tenmpname=getName(25);
        $_SESSION['session_name']=$tenmpname;
        $sql = "insert into log(session_name,date) values('$tenmpname',cast('".date("Y/m/d")."' as date))";
        $con->query($sql);
    }
?>
<html>

<head>
    <script src="js/jquery.js"></script>
    <script src="js/dim.js"></script>
    <link rel="stylesheet" href="css/main.css?v=22">
</head>

<body>
    <div class="back">
        <img src="images/back.jpg" alt="">
    </div>
    <div class="content">
        <div class="header"><a href="#">Login</a></div>
        <h1>Selamat Datang di web Pustakaku</h1>
        <div class="row">
            <div class="box">
                <a href="#info">Read More</a>
            </div>
            <div class="box">
        
        </div>
        </div>
        <div class="mdl" id="info"></div>
    </div>
</body>

</html>