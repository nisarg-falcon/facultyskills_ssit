<?php
require_once 'connection.php';

session_start();

// this whole page only loads if the logged in user is admin

if($_SESSION['username']=='admin')
    {
    //when a skill is deleted , following code is performed :

    if(isset($_GET['skill_id'])&& isset($_GET['skill_name'])){
        $skill_id = $_GET['skill_id'];

        // this following commented code drops the deleted skill's column from the tbl_skill_points
        // $skill_name = $_GET['skill_name'];
        // $delete = 'alter table tbl_skill_points drop `'.$skill_name.'`;';

        $deleted = mysqli_query($con,$delete);
        $delete_skill = 'delete from tbl_skill_list where skill_id="'.$skill_id.'";';
        $res2 = mysqli_query($con,$delete_skill);
        
        header('location:manage_skill.php');
    }

    // when new skill is created it is added to tbl_skill_list and its new column is created in tbl_skill_points

    if(isset($_POST['submit'])){
        $skill_name = $_POST['create_skill'];
        $create = "ALTER TABLE `tbl_skill_points` ADD `".$skill_name."` FLOAT(20) NOT NULL DEFAULT '0' ;"; // this is the query which creates new column for new skill
        $created = mysqli_query($con, $create);
        $create1 = 'insert into tbl_skill_list values("","'.$skill_name.'");';
        $created1 = mysqli_query($con, $create1);
        if ($created1){
            $reset = "SET @autoid:=0
                        UPDATE tbl_skill_list SET skill_id = @autoid:= (@autoid:= @autoid+1);
                        ALTER TABLE tbl_skill_list AUTO_INCREMENT = 1";
        $res5 = mysqli_query($con,$reset);
        echo $res5;
        }
    }
    ?>

    <html>
        <head>
            <title>Manage Skills</title>
        </head>
        <body>
    <header>
        <h2>add / remove skills</h2>
    </header>
        <!-- table for showing skill from tbl_skill_list -->

            <div class='del_skill'>
                <?php
                    $query1 = 'select skill_name,skill_id from tbl_skill_list';
                    $res1 = mysqli_query($con,$query1);
                    if(mysqli_num_rows($res1)>0){
                        echo '<table>';
                        echo '<tr>';
                        echo '<th>skill name</th>';
                        echo '<th>action</th>';
                        echo '</tr>';
                        while($row=mysqli_fetch_row($res1)){
                            echo '<tr>';
                            echo '<td>'.$row[0].'</td>';
        
                            // showing rows from skills and creatting delete link

                            echo '<td><a href="manage_skill.php?skill_id='.$row[1].'&skill_name='.$row[0].'">Delete</a></td>';
                            echo '</tr>';
                        }
                        echo '</table>';
                    }else{
                        // if tbl_skill_list is empty then following is shown :
                        echo '<h3>No Skills Added Yet.</h3>';
                    }
                ?>
            </div>
            <div class='create_skill'>

                <!-- form to create new skill -->

            <form action="" method='post'>
                <input type="text" name="create_skill">
                <input type="submit" name='submit'>   
            </form>
        </div>

    <!-- logic to show skill points dynamically -->
    <h3>below skills are shown dynamically</h3>
    <?php
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
        echo "<table>";
        while($row=mysqli_fetch_row($res4)){
            echo "<tr>";
            $cnt = $count;
            while(0<$cnt){
                echo '<td>'.$row[$cnt-1].'</td>';
                $cnt--;
                
            }
            echo "</tr>";
        }
        echo "</table>";
        ?>

        </body>
    </html>
    <?php 
} 
?>