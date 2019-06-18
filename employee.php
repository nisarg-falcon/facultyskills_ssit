
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
    <link rel="stylesheet" href="css/employee.css">
    <!-- <link rel="stylesheet" href="css/skill.css"> -->
</head>
<body>
<div class="container">
<div class="register">
    <form class="form3" name="form1" action="" method="POST">
        <h1>Sign Up</h1>
        <input type="text" autocomplete="off" name="name" class="name" placeholder="name">
        <span class="name_error"></span>
        <input type="text" autocomplete="off" name="username" class="user" placeholder="username">
        <span class="username_error"></span>
        <input type="password" name="password" class="pass" placeholder="password">
        <span class="password_error"></span>
        <input type="password" name="confirm_password" class="conpass" placeholder="confirm password">
        <span class="confpass_error"></span>
        <div class="Branch">
            <a>Select Branch: </a>
            <select name="select1" class="select">
            <option value="">Select an Option</option>
                <?php
                $res = mysqli_query($con ,'select * from tbl_branch');
                while ($row = mysqli_fetch_row($res)) {
                ?>
                <option value="<?php echo $row[1]; ?>">
                    <?php echo $row[1]; ?>
                </option>
                
                <?php
                }  
                ?>                  
            </select>
        </div>
        <span class="branch_error"></span>
        <div class="Occuption">
            <a>Select Designation: </a>
            <select name="select2" class="occup">
            <option value="">Select an Option</option>
            <?php
                $res = mysqli_query($con ,'select * from tbl_designation');
                while ($row = mysqli_fetch_row($res)) {
                ?>
                <option value="<?php echo $row[1]; ?>">
                    <?php echo $row[1]; ?>
                </option>
                
                <?php
                }  
                ?>                            
            </select>
            <span class="occp_error"></span>
        </div>
            <input type="submit" name="register" value="Register">
    </form>
</div>
<form action="" method="POST">
<div class="form2">
            <h1>Remove Employee</h1>
            <div>
                <label>Department :</label>
                <select name="select1">
                <?php
                    $res = mysqli_query($con ,'select * from tbl_branch');
                    while ($row = mysqli_fetch_row($res)) {
                ?>
                <option value="<?php echo $row[1]; ?>">
                    <?php echo $row[1]; ?>
                </option>
                
                <?php
                 }  
                ?>
                </select>
            </div>
                
            <div>
                <label>Designation :</label>
                <select name="select2">
                <?php
                    $res = mysqli_query($con ,'select * from tbl_designation');
                    while ($row = mysqli_fetch_row($res)) {
                ?>
                <option value="<?php echo $row[1]; ?>">
                    <?php echo $row[1]; ?>
                </option>

                <?php
                    }
                ?>
                </select>
            </div>
            <button name="submit">Submit</button>    
           
        </div>
        <div class="dy_table">
            <?php
            if (isset($_POST['submit'])) {
                $dept = $_POST['select1'];
                $desgn = $_POST['select2'];
            ?>
            <table>
            <tr>
                <th>name</th>
                <th>username</th>
                <th>Delete</th>
            </tr>
        <?php
        if ($desgn == 'hod' || $desgn == 'HOD') {
            $q = "select hod_name,hod_username from tbl_hod where hod_is_active='active' and branch_name='" . $dept . "'";
            $res = mysqli_query($con ,$q);
            while ($row = mysqli_fetch_row($res)) {
        ?>
            <tr>
                <td>
                <?php echo $row[0]; ?>
                </td>
                <td>
                <?php echo $row[1]; ?>
                </td>
                <td>
                <a href='employee.php?delete_hod=<?php echo $row[1]; ?>'>Delete</a>
            
            </td>               
            </tr>
            <?php
                    }
                } else {
                    $q = "select staff_name, staff_username from tbl_staff where staff_is_approved='active' and designation_name='" . $desgn . "' and branch_name='" . $dept . "'";
                    $res = mysqli_query($con ,$q);
                    while ($row = mysqli_fetch_row($res)) {
            ?>
                <tr>
                    <td>
                    <?php echo $row[0]; ?>
                    </td>
                    <td>
                    <?php echo $row[1]; ?>
                    </td>
                    <td>
                    <a href='employee.php?delete_staff=<?php echo $row[1]; ?>'>Delete</a>
           
            </td>
            </tr>
            <?php        
                    }
                }
                echo '</table>';
            }
        ?>
    </div>
        </form>
        </div>
    </body>
</html>
<?php
        if(isset($_GET['delete_staff'])) {
        $sql="delete from tbl_staff where staff_username='".$_GET['delete_staff']."' ";
        $result= mysqli_query($con , $sql);
        if($result == 1){
            echo '<script>alert("staff deleted");</script>';
            header('location: employee.php');
        }
        else{
            echo "<script>alert('error');</script>";
        }
        }
    ?>
    <?php
            if(isset($_GET['delete_hod'])) {
                $sql="delete from tbl_hod where hod_username='".$_GET['delete_hod']."' ";
                 $result= mysqli_query($con , $sql);
                 if($result == 1){
                    echo '<script>alert("staff deleted");</script>';
                    header('location: employee.php');
                }
                else{
                    echo "<script>alert('error');</script>";
                }
            }
    ?>
    <?php
        if(isset($_GET['delete_staff'])) {
        $sql="delete from tbl_staff where staff_username='".$_GET['delete_staff']."' ";
        $result= mysqli_query($con , $sql);
        if($result == 1){
            echo '<script>alert("staff deleted");</script>';
            header('location: employee.php');
        }
        else{
            echo "<script>alert('error');</script>";
        }
        }
    ?>
    <?php
            if(isset($_GET['delete_hod'])) {
                $sql="delete from tbl_hod where hod_username='".$_GET['delete_hod']."' ";
                 $result= mysqli_query($con , $sql);
                 if($result == 1){
                    echo '<script>alert("staff deleted");</script>';
                    header('location: employee.php');
                }
                else{
                    echo "<script>alert('error');</script>";
                }
            }
    ?>
    <?php

        if(isset($_POST['register'])){
            
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
                   header('Location: employee.php');
               }
           
           
            }
            else{
           
               $sql = "INSERT INTO tbl_staff (staff_name,staff_username,branch_name,designation_name,staff_is_approved,staff_password) values ('$name','$username','$branch','$desgn','$status','$hash_pass')";
               $res = mysqli_query($con,$sql);
               
               if($res){
                   header('Location: employee.php');
               }
           
            }
        }