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
    <title>Today Chart</title>
</head>
<body>
    <canvas id="tdday"></canvas>
    <script>
        var ctx3 = document.getElementById('tdday').getContext('2d');
    </script>
</body>
</html>

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
