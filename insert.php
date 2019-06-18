<?php
    include_once ('connection.php');
  //  error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/insert.css">
    <!-- <link rel="stylesheet" href="css/skill.css"> -->
</head>
<body>
    <form action="" method="POST" class="form-insert">
        <div class="form1">
            <h1>Add Designation</h1>
            <p>Note: Fill only required</p>
            <div>
                <label>Designation : </label> &nbsp;
                <input type="text" name="designation">
            </div>
            <div>
                <label>Department : </label> &nbsp;
                <input type="text" name="department">
            </div>
            <button name="submit_desgn">Submit</button>
        </div>       
    </form>
</body>
</html>
<?php
if(isset($_POST['submit_desgn'])){
    $department = $_POST['department'];
    $designation = $_POST['designation'];
    $con  = mysqli_connect($server,$user,$pass,$db);
if(!$con){
    echo "connection unsuccesfull".mysqli_connect_error();
}
if($department != null){
    $sql1= "select distinct branch_name from tbl_branch where branch_name = '$department' ";
    $res1= mysqli_query($con,$sql1);
    $row1 = mysqli_num_rows($res1);
    if($row1 == 0){
        $sql = "insert into tbl_branch (branch_name) values ('$department')";
        $res = mysqli_query($con,$sql);
        if($res != 0){
            header('Location: insert.php');
        }
    }
    else{
        echo "<script>alert('department already exist');</script>";
    }
    
}
if($designation != null){
    $sql1= "select distinct designation_name from tbl_designation where designation_name = '$designation' ";
    $res1= mysqli_query($con,$sql1);
    $row1 = mysqli_num_rows($res1);
    if($row1 == 0){
        $sql = "insert into tbl_designation (designation_name) values ('$designation')";
        $res = mysqli_query($con,$sql);
        if($res != 0){
            header('Location: insert.php');
        }
    }
    else{
        echo "<script>alert('designation already exist');</script>";
    }
}
}

?>