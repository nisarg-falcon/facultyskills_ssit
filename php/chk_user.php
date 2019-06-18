<?php
     $server = "sql211.epizy.com";
    $user = "epiz_23746725";
    $pass = "NlCt712K";
    $db = "epiz_23746725_ssit_db";

    $con = mysqli_connect($server,$user,$pass,$db);
    if(!$con){
        echo "error".mysqli_connect_error();
    }

    if(isset($_POST['name'])){
        $data = $_POST['name'];
        $sql = "SELECT * FROM tbl_staff WHERE staff_username = '$data'";
        $res = mysqli_query($con,$sql);
        $row = mysqli_num_rows($res);
        if($row == 0){
            $sql = "SELECT * FROM tbl_hod WHERE hod_username = '$data'";
            $res = mysqli_query($con,$sql);
            $row = mysqli_num_rows($res);
            echo $row;
        }
        else{
            echo $row;
        }
    }