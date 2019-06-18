<?php
    include '../../connection.php';
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
    <link rel="stylesheet" href="../../css/chart.css" >
    <title>Chart</title>
</head>

<body>
    <canvas id="ystrday"></canvas>
    
    <script>
        var ctx2 = document.getElementById('ystrday').getContext('2d');
    </script>
</body>
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
