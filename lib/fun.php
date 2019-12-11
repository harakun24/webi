<?php
function getName($n) { 
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    $randomString = ''; 
  
    for ($i = 0; $i < $n; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $randomString .= $characters[$index]; 
    } 
  
    return $randomString; 
}
function getPIN() { 
    $characters = '0123456789'; 
    $randomString = ''; 
  
    for ($i = 0; $i < 5; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $randomString .= $characters[$index]; 
    } 
  
    return $randomString; 
}
function connect(){
    $con = new mysqli("localhost", "root", "", "web");
    if ($con->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $con;
}
?>