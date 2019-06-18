<?php
   // error_reporting(0);
    include '../connection.php';
    session_start();
    if($_SESSION['session_state']==''){
        header('location: index.php');
    }
?>

<!-- today skill table -->
<head>
    <link rel="stylesheet" href="../css/skill.css">
</head>
<?php
    $date = date("Y-m-d");
    $query1 = mysqli_query($con, "select DISTINCT to_username,date,skill1,skill2,skill3,skill4,skill5,skill6 from tbl_skill_points where to_username = '".$_SESSION['username']."' and date = '$date' ");
    $count = mysqli_num_rows($query1);

    if($count == 1){
?>
    <table>
        <?php
            if($count != 0)
            {
            ?>
                <tr>
                    <th colspan='7'>Today</th>
                </tr>
                <tr>
                    <th>DATE</th>
                    <th>skill1</th>
                    <th>skill2</th>
                    <th>skill3</th>
                    <th>skill4</th>
                    <th>skill5</th>
                    <th>skill6</th>
                </tr>                        
                <?php
                while($row1 = mysqli_fetch_array($query1)) {
                ?>
                <tr>
                    <td><?php echo $row1['date'] ?></td>
                    <td><?php echo $row1['skill1'] ?></td>
                    <td><?php echo $row1['skill2'] ?></td>
                    <td><?php echo $row1['skill3'] ?></td>
                    <td><?php echo $row1['skill4'] ?></td>
                    <td><?php echo $row1['skill5'] ?></td>
                    <td><?php echo $row1['skill6'] ?></td>
                </tr>
            <?php
                }
            }
            ?>
    </table>
<?php
    }
    else{
        echo "<h1 style='color:#34495e; text-align:center;'>Today's rank not given</h1>";
    }
?>