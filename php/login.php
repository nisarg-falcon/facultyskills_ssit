<?php 
 $server = "localhost";
 $user = "root";
 $pass = "";
 $db = "ssit_db";

 $con = mysqli_connect($server,$user,$pass,$db);
 session_start();

 if(!$con){
     echo "Connection Unsuccessful".mysqli_connect_error();
 }

 $username = mysqli_real_escape_string($con,$_POST['username']);
 $password = mysqli_real_escape_string($con,$_POST['password']);
 $desgn =  $_POST['select2'];

 
 $salt = "ss123";
 $new_pass = $password.$salt;
 $hash = password_hash($new_pass,PASSWORD_DEFAULT);
 if( $username == "admin"){
    $sql = "SELECT admin_password FROM tbl_admin WHERE admin_username = '$username'";
    $res = mysqli_query($con,$sql);
    $arr = mysqli_fetch_assoc($res);
    $pass = $arr['admin_password'];
    $row = password_verify($new_pass,$pass);
    if($row){
        $_SESSION['session_state'] = 'active';
        $_SESSION['username']= $username;
        $_SESSION['desgn']= 'admin';
        header('Location: ../admin_panel.php');
   }
   else{
       $error="incorrect password or username.";
       header('Location: ../index.php?error='.$error.'');
   }
 }
 elseif( $desgn == "HOD" || $desgn == "hod"){
    $sql = "SELECT hod_password FROM tbl_hod WHERE hod_username = '$username' ";
    $res = mysqli_query($con,$sql);
    $arr = mysqli_fetch_assoc($res);
    $pass = $arr['hod_password'];
    $row = password_verify($new_pass,$pass);
    if($row){
        $sql2 = "SELECT hod_is_active FROM tbl_hod WHERE hod_username = '$username' ";
        $is_active = mysqli_query($con,$sql2);
        $result = mysqli_fetch_assoc($is_active);
        if($result['hod_is_active'] == 'active'){
        $_SESSION['session_state'] = 'active';
        $_SESSION['username']= $username;
        $_SESSION['desgn']= $desgn;
        header('Location: ../hod_panel.php');
        } else {
            $error="Your account is not active. Access Denied!!!";
            header('Location: ../index.php?error='.$error.'');
        }
       
   }
   else{
       $error="incorrect password or username.";
       header('Location: ../index.php?error='.$error.'');
       
   }
 }
 else{
    $sql = "SELECT staff_password FROM tbl_staff WHERE staff_username = '$username' ";
    $res = mysqli_query($con,$sql);
    $arr = mysqli_fetch_assoc($res);
    $pass = $arr['staff_password'];
    $row = password_verify($new_pass,$pass);
    if($row){
        $sql2 = "SELECT staff_is_approved FROM tbl_staff WHERE staff_username = '$username' ";
        $is_active = mysqli_query($con,$sql2);
        $result = mysqli_fetch_assoc($is_active);
        if($result['staff_is_approved'] == 'active'){
        $_SESSION['session_state'] = 'active';
        $_SESSION['username']= $username;
        $_SESSION['desgn']= $desgn;
        header('Location: ../faculty_panel.php');
        } else {
            $error="Your account is not active. Access Denied!!!";
            header('Location: ../index.php?error='.$error.'');
        }
   }
   else{
       $error="incorrect password or username.";
       header('Location: ../index.php?error='.$error.'');
   } 
 }