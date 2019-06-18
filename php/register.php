<?php 
   $server = "localhost";
   $user = "root";
   $pass = "";
   $db = "ssit_db";

 $con = mysqli_connect($server,$user,$pass,$db);

 if(!$con){
     echo "Connection Unsuccessful".mysqli_connect_error();
 }

 //Posting variables to php variables
 $name = mysqli_real_escape_string($con,$_POST['name']);
 $username = mysqli_real_escape_string($con,$_POST['username']);
 $password = mysqli_real_escape_string($con,$_POST['password']);
 $branch = mysqli_real_escape_string($con,$_POST['select1']);
 $desgn = mysqli_real_escape_string($con,$_POST['select2']);
 $status = "inactive"; 

 // Hashing and Salting Done Here 
 $salt = "ss123";
 $new_pass = $password.$salt;
 $hash_pass = password_hash($new_pass,PASSWORD_DEFAULT);

// 
 if($desgn == "HOD" || $desgn == "hod"){
     
    $sql = "INSERT INTO tbl_hod (hod_name,hod_username,branch_name,hod_is_active,hod_password) values ('$name','$username','$branch','$status','$hash_pass')";
    $res = mysqli_query($con,$sql);

    if($res){
        header('Location: ../index.php');
    }


 }
 else{

    $sql = "INSERT INTO tbl_staff (staff_name,staff_username,branch_name,designation_name,staff_is_approved,staff_password) values ('$name','$username','$branch','$desgn','$status','$hash_pass')";
    $res = mysqli_query($con,$sql);
    
    if($res){
        header('Location: ../index.php');
    }

 }
 ?>