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
    <title>skill total</title>
</head>
<body>
    <canvas id="sktotal"></canvas>
    <script>
        var ctx5 = document.getElementById('sktotal').getContext('2d');
    </script>

    <!-- total -->
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