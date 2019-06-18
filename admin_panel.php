<?php
    include 'connection.php';
    session_start();
    if($_SESSION['session_state']==''){
        header('location: index.php');
    }
    elseif($_SESSION['desgn']!='admin'){
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
    <title>Admin Panel</title>
    <link href="css/admin.css" rel="stylesheet">
    <link href="css/admin_responsive.css" rel="stylesheet">
    <script src="js/admin.js"></script>
</head>
<body>
    <div class="main_container">
        <div class="sidebar">
         <!--   <div class="info">
                <h1>SSIT</h1>
            </div>-->
            <div class="skills"><a class="item active">Skills</a></div>
            <!--<img src="/assests/img/baseline_settings_white_18dp.png" height="20px" width="20px">-->
            <div class="grade"><a class="item">Inbox</a></div>
            <div class="score"><a class="item">Score</a></div>
            <div class="designation"><a class="item">Designation</a></div>
            <div class="employee"><a class="item">Employee</a></div>
            <div class="manage_skill"><a class="item">Manage Skills</a></div>
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
                <iframe height="99%" width="100%" id="ifrm" frameborder="0" src="skill.php"></iframe>
            </div>
        </div>
    </div>
</body>
</html>