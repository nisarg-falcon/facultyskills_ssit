<?php
include_once('connection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <!--    <script src="js/skill.js"></script> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script defer src="https://use.fontawesome.com/releases/v5.8.1/js/all.js" integrity="sha384-g5uSoOSBd7KkhAMlnQILrecXvzst9TdC09/VM+pjDTCM+1il8RHz5fKANTFFb+gQ" crossorigin="anonymous">
    </script>
    <link href="css/skill.css" rel="stylesheet">
</head>

<body>
    <div class="main_container">
        <div class="header">
            <form name="form1" method="post">
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
                <a>Designation</a>
                <select name="select2">
                    <?php
                    $res = mysqli_query($con, 'select * from tbl_designation');
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
           if (isset($_GET['username']) && isset($_GET['desgn']) && isset($_GET['dept'])) {
            $user = $_GET['username'];
            $desgn = $_GET['desgn'];
            $dept = $_GET['dept'];
            ?>

            <div class="skill_container">
                <div class="flex_contain">
                    <form method="post" action="skill.php?username=<?php echo $user; ?>&desgn=<?php echo $desgn; ?>&dept=<?php echo $dept; ?>">
                    <table>
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
                            // $skill1 = $_POST['skill1'];
                            // $skill2 = $_POST['skill2'];
                            // $skill3 = $_POST['skill3'];
                            // $skill4 = $_POST['skill4'];
                            // $skill5 = $_POST['skill5'];
                            // $skill6 = $_POST['skill6'];

    // get all skill names dynamically from tbl_skill_list

                                $q = 'select skill_name from tbl_skill_list';
                                $res3 = mysqli_query($con,$q);
                                if(mysqli_num_rows($res3)>0){
                                    // $count is the number of skills 
                                    $count = mysqli_num_rows($res3);
                                    $a = '';
                                    $counter = 0;
                                    // all the skill names and storing them sequentially in variable $a
                                    while($row=mysqli_fetch_row($res3)){
                                        $a = $a.$row[0].(($counter<$count-1)?',':'');
                                        $counter++;
                                        if($count==$counter){
                                            $skill_list = $a;
                                        }
                                    }
                                }

                                // the $skill_list contains all the skill names with a separator ','
                                // example $skill_list = 'skill1,skill2,skill3';

                                $q2 = "select ".$skill_list." from tbl_skill_points;";
                                $res4 = mysqli_query($con, $q2);
                            
                                $b = '';
                                $counters = 0;
                                    
                                $skills = explode(',',$skill_list);
                                $skill_count = count($skills);
                                while($skill_count>0){
                                    // skill points input field names are same as their corresponding skill name 
                                    // add all skills points to variable b 
                                    $b = $b."'".$_POST[$skills[$skill_count-1]]."'".(($counters<$skill_count+3)?',':'');
                                        $counters++;
                                        if($skill_count==$counters){
                                            $skill_list1 = $b;
                                        }
                                    $skill_count--;
                                }
        
                            $date = date("Y-m-d");
                            if ($desgn == 'HOD') 
                            {
                                $insert = "insert into tbl_skill_points(from_username,to_username,branch_name,date,$skill_list) values('admin','$user','$dept','$date',".strrev($b).")";
                                
                                $inserted = mysqli_query($con, $insert);
                                if ($inserted == true) 
                                {
                                    echo "<script>alert('skills accepted');</script>";
                                    echo "<script>window.location.href='skill.php';</script>";
                                }
                            } else {
                                $insert = "insert into tbl_skill_points(from_username,to_username,branch_name,date,$skill_list) values('admin','$user','$dept','$date',".strrev($b).")";

                                $inserted = mysqli_query($con, $insert);
                                if ($inserted == true)
                                {
                                    echo "<script language='javascript'>alert('skills accepted');</script>";
                                    echo "<script>window.location.href='skill.php';</script>";
                                }
                            }
                            

                        }
                        
                        ?>
                    </form>
                </div>

            </div>
        <?php
    }
       else if (isset($_POST['submit'])) {
            $dept = $_POST['select1'];
            $desgn = $_POST['select2'];
            if ($desgn == 'hod' || $desgn == "HOD") {
                $q = "select hod_name,hod_username from tbl_hod where hod_is_active='active' and branch_name='" . $dept . "'";
                $res = mysqli_query($con, $q);
                $rowcount = mysqli_num_rows($res);
                if ($rowcount != 0) {
                    ?>
                        <table>
                            <tr>
                                <th>name</th>
                                <th>username</th>
                                <th>Action</th>
                            </tr>
                            <?php
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
                                        <a href='skill.php?username=<?php echo $row[1]; ?>&desgn=<?php echo $desgn; ?>&dept=<?php echo $dept; ?>'><i class="fas fa-user-edit fa"></i></a>
                                    </td>

                                </tr>

                            <?php
                        }
                        ?>
                        </table>
                    <?php
                }
            }  else{
                ?>
                    <table>
                        <tr>
                            <th>name</th>
                            <th>username</th>
                            <th>action</th>
                        </tr>
                        <?php
                        $q = "select staff_username, staff_name from tbl_staff where staff_is_approved='active' and designation_name='" . $desgn . "' and branch_name='" . $dept . "'";
                        $res = mysqli_query($con, $q);
                        while ($row = mysqli_fetch_row($res)) {
                            ?>

                            <tr>
                                <td>
                                    <?php echo $row[1]; ?>
                                </td>
                                <td>
                                    <?php echo $row[0]; ?>
                                </td>
                                <td>
                                    <a href='skill.php?username=<?php echo $row[0]; ?>&desgn=<?php echo $desgn; ?>&dept=<?php echo $dept; ?>'><i class="fas fa-user-edit fa"></i></a>
                                </td>

                            </tr>



                        <?php
                    }
                } 
                ?>
                </table>

            <?php
        }
        ?>
        </div>
    </div>
</body>

</html>