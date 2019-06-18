<?php
   // error_reporting(0);
    include '../connection.php';
    session_start();
    if($_SESSION['session_state']==''){
        header('location: index.php');
    }
?>
<!-- monthly skill table -->
<head>
    <link rel="stylesheet" href="../css/skill.css">
</head>
<table>
    <?php
    //$date = date("Y-m-d");
    $query1 = mysqli_query($con, "SELECT year(date),monthname(date),avg(skill1),avg(skill2),avg(skill3),avg(skill4),avg(skill5),avg(skill6) from tbl_skill_points WHERE to_username = '".$_SESSION['username']."' GROUP by YEAR(date), MONTH(date) ");
    $count = mysqli_num_rows($query1);
        if($count != 0)
        {
        ?>
            <tr>
                <th colspan='8'>Average of skill's Month-wise</th>
            </tr>
            <tr>
                <th>Year</th>
                <th>Month</th>
                <th>Average skill1</th>
                <th>Average skill2</th>
                <th>Average skill3</th>
                <th>Average skill4</th>
                <th>Average skill5</th>
                <th>Average skill6</th>
            </tr>                        
            <?php
            while($row1 = mysqli_fetch_array($query1)) {
            ?>
            <tr>
                <td><?php echo $row1[0] ?></td>
                <td><?php echo $row1[1] ?></td>
                <td><?php echo $row1[2] ?></td>
                <td><?php echo $row1[3] ?></td>
                <td><?php echo $row1[4] ?></td>
                <td><?php echo $row1[5] ?></td>
                <td><?php echo $row1[6] ?></td>
                <td><?php echo $row1[7] ?></td>
            </tr>
        <?php
            }
        }
        ?>
</table>
