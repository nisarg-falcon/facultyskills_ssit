 <?php
    include '../connection.php';
    session_start();
    $user = $_SESSION['username'];
    $sql = "SELECT branch_name FROM tbl_hod WHERE hod_username = '$user'";
    $res = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($res);
    $branch =  $row['branch_name'];    
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/hod_skill.css">
    <title>Document</title>
</head>
<body>
    <?php
          // when user is selected
          if(isset($_GET['username'])){
            $selected = $_GET['username'];
 
            ?>
            <div class="skill_container">
            <div class="flex_contain">
                <form method="post" action="hod_skill.php?username=<?php echo $selected; ?>">
                <table class="table_skill">
                    <tr>
                        <th>Skill</th>
                        <th>Points</th>
                    </tr>    
                    <?php
                    $m = "select skill_name from tbl_skill_list";
                    $result = mysqli_query($con, $m);

                    while (($row = mysqli_fetch_row($result))) 
                    {
                    ?>
                    <tr>
                        <td class="table_data"><?php echo $row[0];?></td>
                        <td class="table_data"><input name="<?php echo $row[0]?>"  placeholder='/ 5'  pattern="[0-5]{1}" maxlength="1" type="text" title='Only Numbers are allowed E.g = 0-5' required></td>
                    </tr>    
                    <?php
                        }
                    ?>
                    <tr> 
                    <td colspan="2"> <input type="submit" name="submit_skill" class="table_data"></td>
                    </tr>   
                </table>
                    <?php
                    if (isset($_POST['submit_skill'])) {
                        $skill1 = $_POST['skill1'];
                        $skill2 = $_POST['skill2'];
                        $skill3 = $_POST['skill3'];
                        $skill4 = $_POST['skill4'];
                        $skill5 = $_POST['skill5'];
                        $skill6 = $_POST['skill6'];
                        $date = date("Y-m-d");
                        $insert = "insert into tbl_skill_points(from_username,to_username,branch_name,date,skill1,skill2,skill3,skill4,skill5,skill6) values('$user','$selected','$branch','$date',' $skill1',' $skill2',' $skill3',' $skill4',' $skill5',' $skill6')";
                        $inserted = mysqli_query($con, $insert);
                        if ($inserted == true)
                        {
                            echo "<script language='javascript'>alert('skills accepted');</script>";
                            echo "<script>window.location.href='hod_skill.php';</script>";
                        }
                        }
                    
                    
                    ?>
                </form>
            </div>

        </div>
         <?php   
        }
        else{
            ?>
            <table >
                <tr>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Action</th>
                </tr> 
                <?php
                    $sql = "SELECT * FROM tbl_staff WHERE branch_name = '$branch'";
                    $res = mysqli_query($con,$sql);
                    while($row=mysqli_fetch_row($res)){
                ?>        
                    <tr>
                        <td class='table_data'><?php echo $row[1]; ?></td>
                        <td class='table_data'><?php echo $row[2]; ?></td>
                        <td class='table_data'><a href='hod_skill.php?username=<?php echo $row[2];?>'>select</a></td>
                    </tr>    
                <?php    
                    }
        
        }          
        ?>      
    </table>
</body>
</html>