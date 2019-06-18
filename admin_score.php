<?php
    // error_reporting(0);
    include 'connection.php';
    session_start();
    if($_SESSION['session_state']==''){
        header('location: index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Faculty Panel</title>
    <link rel="stylesheet" href="css/admin_score.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>
<body>
<div class="main_container">
    <div class="header">
        <form name="form1" method="post">
        <h2 style="text-align:center;"> Search user Department-wise </h2>
            <a>Department</a>
            <select name="select1">
                <?php
                $res = mysqli_query($con, 'select * from tbl_branch');
                while ($row = mysqli_fetch_row($res)) {
                ?>
                    <option value="<?php echo $row[1]; ?>">
                        <?php echo $row[1]; ?>
                    </option>
                <?php
                }
                ?>    
            </select>

         
            <button name='submit'>Submit</button>
        </form>
    </div>

    <div class="dynamic">
        <?php
        if (isset($_POST['submit'])) {
        $dept = $_POST['select1'];
          
                ?>
                <table>
                    <?php
                    $q = "SELECT to_username,count(date),SUM(skill1),SUM(skill2),SUM(skill3),SUM(skill4),SUM(skill5),SUM(skill6), sum(skill1+skill2+skill3+skill4+skill5+skill6) as total FROM tbl_skill_points where branch_name = '$dept' GROUP BY to_username ";
                    //$q = "select staff_username, staff_name from tbl_staff where staff_is_approved='active' and designation_name='" . $desgn . "' and branch_name='" . $dept . "'";
                    $res = mysqli_query($con, $q);
                    $rowcount = mysqli_num_rows($res);
                    if($rowcount != 0) {
                        ?>
                        <tr>
                            <th colspan='9'>Total Score</th>
                        </tr>
                        <tr>
                            <th>username</th>
                            <th>Total DATE</th>
                            <th>Total Skill1</th>
                            <th>Total Skill2</th>
                            <th>Total Skill3</th>
                            <th>Total Skill4</th>
                            <th>Total Skill5</th>
                            <th>Total Skill6</th>
                            <th>Total</th>
                        </tr>                        
                        <?php
                        while($row1 = mysqli_fetch_array($res)) {
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
                            <td><?php echo $row1[8] ?></td>
                        </tr>
                    <?php
                        }
                    }
                 
            }
                ?>
                </table>
                
        </div>
</div>

            <!-- <table>     
                <?php
                // if(isset($_GET['username'])) {
                // $query= mysqli_query($con, "select count(date), sum(skill1),sum(skill2),sum(skill3),sum(skill4),sum(skill5),sum(skill6) from tbl_skill_points where staff_username = '".$_GET['username']."' ");
                // // skill 1 to 6 total 
                // //SELECT staff_username,date,skill1,skill2,skill3,skill4,skill5,skill6, sum(skill1+skill2+skill3+skill4+skill5+skill6) as Total from tbl_skill_points group by point_id
                // $count= mysqli_num_rows($query);
                // if($count != 0) {
                ?>
                    <tr>
                        <th colspan='7'>Total Score</th>
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
                    //while($row1 = mysqli_fetch_array($query)) {
                    ?>
                    <tr>
                        <td><?php echo $row1[0] ?></td>
                        <td><?php echo $row1[1] ?></td>
                        <td><?php echo $row1[2] ?></td>
                        <td><?php echo $row1[3] ?></td>
                        <td><?php echo $row1[4] ?></td>
                        <td><?php echo $row1[5] ?></td>
                        <td><?php echo $row1[6] ?></td>
                    </tr>
                    <?php
            //         }
            //     }
            // }
            ?>
            </table> -->