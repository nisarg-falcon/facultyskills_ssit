<?php
    include 'connection.php';
    session_start();
    if($_SESSION['session_state']==''){
        header('location: index.php');
    }
    $user = $_SESSION['username'];
?>    
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/chart.css" >
   <!-- <script src="chart.js"></script> -->
    <title>Chart</title>
</head>
<body>
    <div class="header">
    <div class="user_information">
                    <h1>Welcome, <?php echo $_SESSION['username']; ?></h1>
                    <a href="php/logout.php" >Logout</a>
    </div>
         <form method='post'>
                    <select name='month'>
                        <option value="01">January</option>
                        <option value="02">Febuary</option>
                        <option value="03">March</option>
                        <option value="04">April</option>
                        <option value="05">May</option>
                        <option value="06">June</option>
                        <option value="07">July</option>
                        <option value="08">Augest</option>
                        <option value="09">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                        <input type='submit' name='btnsubmit'>
                </form>

    </div>         
    <canvas id="btwdates"></canvas>
    <canvas id="ystrday"></canvas>
    <canvas id="tdday"></canvas>
    <canvas id="lstuptd"></canvas>
    <canvas id="sktotal"></canvas>

    <script>
        var ctx1 = document.getElementById('btwdates').getContext('2d');
        var ctx2 = document.getElementById('ystrday').getContext('2d');
        var ctx3 = document.getElementById('tdday').getContext('2d');
        var ctx4 = document.getElementById('lstuptd').getContext('2d');
        var ctx5 = document.getElementById('sktotal').getContext('2d');
        <?php
                    $date = date("Y-m-d");
                    $sql = "select to_username,date,skill1,skill2,skill3,skill4,skill5,skill6 from tbl_skill_points where to_username = '".$_SESSION['username']."' order by date desc limit 1 ";
                    $query1 = mysqli_query($con,$sql );
                    $count = mysqli_num_rows($query1);
        ?>
        var myChart = new Chart(ctx4, {
        type: 'line',
        data: {
        labels: ['skill1', 'skill2', 'skill3', 'skill4', 'skill5', 'skill6'],
        datasets: [{
            label: 'LAST UPDATED RANK SCORE',
            data: [
                <?php
                    while($row1 = mysqli_fetch_array($query1)){
                    echo $row1['skill1'].",".$row1['skill2'].",".$row1['skill3'].",".$row1['skill4'].",".$row1['skill5'].",".$row1['skill6']; 
                    }
                    ?>       
            ],
            backgroundColor: 'transparent',
            borderColor: 'purple',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>
<!-- month search -->
<?php
                if(isset($_POST['btnsubmit'])) {
                    $month= $_POST['month'];
                    $logic = mysqli_query($con, "SELECT year(date),monthname(date),avg(skill1),avg(skill2),avg(skill3),avg(skill4),avg(skill5),avg(skill6) from tbl_skill_points WHERE to_username = '".$_SESSION['username']."' AND month(date) = '$month'  GROUP by YEAR(date), MONTH(date) ");
                    $count = mysqli_num_rows($logic);
                    if($count != 0) {
                    ?>                 
<script>   
var myChart1 = new Chart(ctx1, {
        type: 'bar',
        data: {
        labels: ['skill1', 'skill2', 'skill3', 'skill4', 'skill5', 'skill6'],
        datasets: [
            <?php
            while($row = mysqli_fetch_array($logic))
            {
            ?>
            { 
            label: '<?php echo $row[1]; ?>',
            data: [
                   <?php echo $row[2].','.$row[3].','.$row[4].','.$row[5].','.$row[6].','.$row[7];?>      
            ],
            backgroundColor: '#<?php echo mt_rand(1000,9999)."FF";?>',
            borderColor: 'purple',
            borderWidth: 1
            }
            <?php 
                $cntr--;
                if($cntr > 0 ){
                    echo ',';
                }
            ?>
        <?php
     } ?>
        
        ]
    },
    options: {
        responsive: true,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
   <?php } ?>
</script>
 <?php } ?>
<!-- ystrday -->
<?php 
   $d=strtotime("yesterday");
   $yesterday = date("Y-m-d", $d);
   $query1 = mysqli_query($con, "select DISTINCT to_username,date,skill1,skill2,skill3,skill4,skill5,skill6 from tbl_skill_points where to_username = '".$_SESSION['username']."' and date = '$yesterday' ");
   $count = mysqli_num_rows($query1);
   if($count != 0)
   {
?>                 
<script>   
var myChart1 = new Chart(ctx2, {
        type: 'line',
        data: {
        labels: ['skill1', 'skill2', 'skill3', 'skill4', 'skill5', 'skill6'],
        datasets: [{
            label: 'Yesterday',
            data: [
                <?php
                    
                    while($row3 = mysqli_fetch_array($query1)){
                    echo $row3['skill1'].",".$row3['skill2'].",".$row3['skill3'].",".$row3['skill4'].",".$row3['skill5'].",".$row3['skill6']; 
                    }
                
                    ?>          
            ],
            backgroundColor: 'transparent',
            borderColor: 'purple',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

</script>
<?php
   }
   ?>
   <!-- today -->
<?php 
  $date = date("Y-m-d");
                   
  $query1 = mysqli_query($con, "select DISTINCT to_username,date,skill1,skill2,skill3,skill4,skill5,skill6 from tbl_skill_points where to_username = '".$_SESSION['username']."' and date = '$date' ");
  $count = mysqli_num_rows($query1);
      if($count != 0)
      {
?>                 
<script>   
var myChart1 = new Chart(ctx3, {
        type: 'line',
        data: {
        labels: ['skill1', 'skill2', 'skill3', 'skill4', 'skill5', 'skill6'],
        datasets: [{
            label: 'Today',
            data: [
                <?php
                    
                    while($row1 = mysqli_fetch_array($query1)){
                    echo $row1['skill1'].",".$row1['skill2'].",".$row1['skill3'].",".$row1['skill4'].",".$row1['skill5'].",".$row1['skill6']; 
                    }
                
                    ?>          
            ],
            backgroundColor: 'transparent',
            borderColor: 'purple',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

</script>
<?php
   }
   ?>
   <!-- t -->
   <?php 
   $query2 = mysqli_query($con, "select count(date), sum(skill1),sum(skill2),sum(skill3),sum(skill4),sum(skill5),sum(skill6), sum(skill1+skill2+skill3+skill4+skill5+skill6) as total from tbl_skill_points where to_username = '".$_SESSION['username']."' ");
   $count = mysqli_num_rows($query2);
       if($count != 0)
       {
?>                 
<script>   
var myChart1 = new Chart(ctx5, {
        type: 'line',
        data: {
        labels: ['skill1', 'skill2', 'skill3', 'skill4', 'skill5', 'skill6'],
        datasets: [{
            label: 'Total',
            data: [
                <?php
                    
                    while($row2 = mysqli_fetch_array($query2)){
                    echo $row2[1].",".$row2[2].",".$row2[3].",".$row2[4].",".$row2[5].",".$row2[6]; 
                    }
                
                    ?>          
            ],
            backgroundColor: 'transparent',
            borderColor: 'purple',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

</script>
<?php
   }
   ?>
</body>
</html>