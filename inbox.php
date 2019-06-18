<?php
    include 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/inbox.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
        <?php

            if(isset($_GET['state'])){
                if($_GET['state']=='done'){
                    echo "<script>alert('Updation Succesfull')</script>";
                }
            }

            if(isset($_GET['name'])&&isset($_GET['desgn'])){
                $name = $_GET['name'];
                $sql = "UPDATE tbl_hod SET hod_is_active = 'active' WHERE hod_name = '$name'";
                $res = mysqli_query($con,$sql);
                if($res){
                    header('location: inbox.php?state=done');
                }
            }
            
            elseif(isset($_GET['name'])){
                $name = $_GET['name'];
                $sql = "UPDATE tbl_staff SET staff_is_approved = 'active' WHERE staff_name = '$name'";
                $res = mysqli_query($con,$sql);
                if($res){
                    header('location: inbox.php?state=done');
                }
            }
        ?>

    <table>
        <tr>
            <th colspan="4">
                Staff
            </th>
        </tr>
        <tr>
            <th>Name</th>
            <th>Branch</th>
            <th>Designation</th>
            <th>Action</th>
        </tr>
        <?php
            $sql = "SELECT * FROM tbl_staff where staff_is_approved = 'inactive'";
            $res = mysqli_query($con,$sql);
            while($row = mysqli_fetch_row($res)){
        ?>  
               <tr>
                <td><?php echo $row[1]?></td>
                <td><?php echo $row[3]?></td>
                <td><?php echo $row[4]?></td>
                <td><a href='inbox.php?name=<?php echo $row[1];?>'>Activate</a></td>
               </tr>    
        <?php    
            }
        ?>
    </table>    
    <table>
        <tr>
            <th colspan="3">
                Head Of Department
            </th>
        </tr>
        <tr>
            <th>Name</th>
            <th>Branch</th>
            <th>Action</th>
        </tr>
        <?php
            $sql = "SELECT * FROM tbl_hod where hod_is_active = 'inactive'";
            $res = mysqli_query($con,$sql);
            while($row = mysqli_fetch_row($res)){
        ?>  
               <tr>
                <td><?php echo $row[1]?></td>
                <td><?php echo $row[3]?></td>
                <td><a href="inbox.php?name=<?php echo $row[1];?>&desgn=hod">Activate</a></td>
               </tr>    
        <?php    
            }
        ?>
    </table> 
</body>
</html> 