<?php
    include 'connection.php';
    session_start();
    if($_SESSION['session_state']==''){
        header('location: index.php');
    }
    elseif($_SESSION['desgn']!='Faculty'){
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
    <link href="css/staff.css" rel="stylesheet">

    <link href="css/admin_responsive.css" rel="stylesheet">
    <script src="js/staff.js"></script>
</head>
<body>
    <div class="main_container">
        <div class="sidebar">
            <div class="total"><a class="item active">Total</a></div>
            <div class="today"><a class="item">Today</a></div>
            <div class="yesterday"><a class="item">Yesterday</a></div>
            <div class="average"><a class="item">Average</a></div>
            <div class="search"><a class="item">Search</a></div>
            <div class="profile"><a class="item">Profile</a></div>
            <div class="logout"><a class="item">Logout</a></div>
        </div>
        
        <div class="primary_container">
            <div class="header">
                <div class="user_information">
                    <i class="fas fa-align-left fa-2x" style="width: 60px; cursor: pointer;"></i>
                    <h2>Welcome,</h2>
                    <h1><?php echo $_SESSION['username']; ?></h1>
                </div>
            </div>
            <div class="workspace">
                <iframe id="ifrm" src="faculty/total.php" frameborder="0"></iframe>
                <iframe id="ifrm1" src="faculty/chart/total_chart.php" frameborder="0"></iframe> 
            </div>
        </div>
    </div>
</body>
</html>