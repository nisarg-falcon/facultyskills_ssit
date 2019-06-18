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
   <!-- <script src="chart.js"></script> -->
    <title>Chart</title>
</head>

<body>
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
                <canvas id="btwdates"></canvas>
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
   <?php } } ?>
</script>
</body>
</html>
