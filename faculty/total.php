<?php
   // error_reporting(0);
    include '../connection.php';
    session_start();
    if($_SESSION['session_state']==''){
        header('location: index.php');
    }
?>

<!-- total skill table -->
<head>
    <link rel="stylesheet" href="../css/skill.css">
</head>
<table>
    <?php
    $query1 = mysqli_query($con, "select count(date), sum(skill1),sum(skill2),sum(skill3),sum(skill4),sum(skill5),sum(skill6), sum(skill1+skill2+skill3+skill4+skill5+skill6) as total from tbl_skill_points where to_username = '".$_SESSION['username']."' ");
    $count = mysqli_num_rows($query1);
        if($count != 0)
        {
        ?>
            <tr>
                <th colspan='8'>Skill's Total</th>
            </tr>
            <tr>
                <th>Total Days</th>
                <th>Total Skill1</th>
                <th>Total Skill2</th>
                <th>Total Skill3</th>
                <th>Total Skill4</th>
                <th>Total Skill5</th>
                <th>Total Skill6</th>
                <th>Total</th>
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
