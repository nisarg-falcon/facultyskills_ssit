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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Faculty Panel</title>
    <link rel="stylesheet" href="css/faculty.css">
    <script src='js/faculty.js'></script>
    <link href="css/admin_responsive.css" rel="stylesheet">
</head>
<body>
    <div class="main_container">
        <!--<div class="sidebar">
            <div class="info">
                <h1>SSIT</h1>
            </div>
            <div class="skills"><a class="item active">Skills</a></div>
            <img src="/assests/img/baseline_settings_white_18dp.png" height="20px" width="20px">
            <div class="profile"><a class="item">Profile</a></div>
            <div class="logout"><a class="item">Logout</a></div>
            <a class="back">Back</a>
        </div>-->
        <div class="primary_container">
            <div class="header">
                <div class="user_information">
                    <h1>Welcome, <?php echo $_SESSION['username']; ?></h1>
                </div>
                <a href="php/logout.php" >Logout</a>
            </div>
            <div class="workspace">
                <div class="header1">
                    <form name="form1" method="post">
                        <div>
                        <a>Starting Date</a>
                        <input type="date" name="startdate" required>
                        </div>
                        <div>
                        <a>Ending Date</a>
                        <input type="date" name="enddate" required>

                        
                    </div>
                    <button name='submit'>Submit</button>    
                </form>
                </div>    
                </div>

                <!-- b/w date search table -->
                <table>
                    <?php 
                    if(isset($_POST['submit'])) {
                    $startdate = $_POST['startdate'];
                    $enddate = $_POST['enddate'];
                    $query = mysqli_query($con, "select DISTINCT to_username,date,skill1,skill2,skill3,skill4,skill5,skill6 from tbl_skill_points where to_username = '".$_SESSION['username']."' and date between '$startdate' and '$enddate' ");
                    $count = mysqli_num_rows($query);                                  
                        if($count != 0) 
                        {
                        ?>
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
                            while($row = mysqli_fetch_array($query)) {
                            ?>
                            <tr>
                                <td><?php echo $row['date'] ?></td>
                                <td><?php echo $row['skill1'] ?></td>
                                <td><?php echo $row['skill2'] ?></td>
                                <td><?php echo $row['skill3'] ?></td>
                                <td><?php echo $row['skill4'] ?></td>
                                <td><?php echo $row['skill5'] ?></td>
                                <td><?php echo $row['skill6'] ?></td>
                            </tr>
                        <?php
                            }
                        }                
                        else
                        {
                        echo "<script>alert('Sorry, no records found');</script>";
                        }
                    }
                    ?>
                </table>

                <!-- last skill table -->
                <table>
                    <?php
                    $date = date("Y-m-d");
                    $query1 = mysqli_query($con, "select to_username,date,skill1,skill2,skill3,skill4,skill5,skill6 from tbl_skill_points where to_username = '".$_SESSION['username']."' order by date desc limit 1 ");
                    $count = mysqli_num_rows($query1);
                        if($count != 0)
                        {
                        ?>
                            <tr>
                                <th colspan='7'>LAST UPDATED RANK SCORE</th>
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

                <!-- yesterday table -->
                
                <table>
                    <?php
                    $d=strtotime("yesterday");
                    $yesterday = date("Y-m-d", $d);
                    $query1 = mysqli_query($con, "select DISTINCT to_username,date,skill1,skill2,skill3,skill4,skill5,skill6 from tbl_skill_points where to_username = '".$_SESSION['username']."' and date = '$yesterday' ");
                    $count = mysqli_num_rows($query1);
                        if($count != 0)
                        {
                        ?>
                            <tr>
                                <th colspan='7'>YESTERDAY</th>
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
                
                <!-- today skill table -->
                <table>
                    <?php
                    $date = date("Y-m-d");
                   
                    $query1 = mysqli_query($con, "select DISTINCT to_username,date,skill1,skill2,skill3,skill4,skill5,skill6 from tbl_skill_points where to_username = '".$_SESSION['username']."' and date = '$date' ");
                    $count = mysqli_num_rows($query1);
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

                <!-- total skill table -->
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

                <!-- monthly skill table -->
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

            </div>
        </div>
    </div>
</body>
</html>