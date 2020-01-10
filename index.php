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
    <script src="app/asset/js/dim2.js"></script>
    <link rel="stylesheet" href="app/asset/css/main.css?v=22">
</head>

<body>
    <div class="back">
        <img src="app/asset/images/back.jpg" alt="">
    </div>
    <div class="content">
        <div class="header"><a href="login">Login</a></div>
        <h1>Selamat Datang di web Pustakaku</h1>
        <div class="row">
            <div class="box">
            <p>
            &nbsp;&nbsp;&nbsp;&nbsp;Lebih dari <b> 40000</b> user telah
            mendaftar. jangan lewatkan kesempatan ini dan mulai bergabung dengan
            pustakaku sekarang.
            </p>
                <a href="#info" id="readme">Read More <div class="contente"></div></a>
            </div>
            <div class="box">
            <p>
            &nbsp;&nbsp;&nbsp;&nbsp;
            Jadilah salah satu dari pegguna
            Pustakaku dan nikmati kemudahan dalam
            pengelolaan perpustakaan berbasis web.
            Klik link berikut
            </p>
            <a href="signup" id="readme">Registrasi <div class="contente"></div></a>

        </div>
        </div>
        <div class="mdl" id="info"></div>
    </div>
</body>

</html>