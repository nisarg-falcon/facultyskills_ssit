<?php
    $server = "localhost";
    $user = "root";
    $pass = "";
    $db = "ssit_db";


    $con  = mysqli_connect($server,$user,$pass,$db);
    if(!$con){
        echo "connection unsuccesfull".mysqli_connect_error();
    }
?>