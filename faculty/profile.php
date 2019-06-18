<?php
   // error_reporting(0);
    include '../connection.php';
    session_start();
    if($_SESSION['session_state']==''){
        header('location: index.php');
    }
    $session_user = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../css/skill.css">
    <link rel="stylesheet" href="css/skill.css">
</head>
<body>
    <?php
    $sql= "select * from tbl_staff where staff_username = '$session_user' ";
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
</body>
</html>