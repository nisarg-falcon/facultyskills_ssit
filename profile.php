<?php
    include ('connection.php');
    session_start();
    $session_user = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/skill.css">
</head>
<body>
    <?php
    $sql= "select * from tbl_hod where hod_username = '$session_user' ";
    $res = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($res);
    $dept = $row[3];
    ?>
    <table>
        <tr >
            <th colspan='3'>My Profile</th>
        </tr>
        <tr>
            <th>Name</th>
            <th>Username</th>
            <th>Branch</th>
        </tr>
        <tr>
            <td><?php echo $row[1]; ?></td>
            <td><?php echo $row[2]; ?></td>
            <td><?php echo $row[3]; ?></td>
        </tr>
    </table>

    <table>
    <tr >
        <th colspan='2'>Staff profile</th>
    </tr>
    <tr >
        <th>Staff Name</th>
        <th>Designation</th>
    </tr>
    <?php
    $sql = "select staff_name, designation_name from tbl_staff where branch_name = '$dept' ";
    $res = mysqli_query($con, $sql);
    while($row = mysqli_fetch_array($res)) {
    ?>
        <tr>    
            <td><?php echo $row[0] ?></td>
            <td><?php echo $row[1] ?></td>
        </tr>
    <?php
    }
    ?>
</body>
</html>