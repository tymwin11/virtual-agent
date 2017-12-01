<?php
    session_start();
    include('connect.php');
?>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>Tacocat Travel Agency - Home</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/styles.css"/>
    <link rel="stylesheet" href="styles/login.css"/>
    <link rel="stylesheet" href="styles/home.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-inverse" id="nav">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="home.php">Tacocat Travels</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="home.php">Home</a></li>
                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Plan<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                    <li><a href="#">Flights</a></li>
                    <li><a href="#">Rentals</a></li>
                    <li><a href="#">Parking</a></li>
                    </ul>
                </li>
            </ul>
            <?php 
                echo $_SESSION['id'];
                if ($_SESSION['id'] == null) {
                    $login_bar = "<ul class=\"nav navbar-nav navbar-right\"><li><a href=\"login.php\"><span class=\"glyphicon glyphicon-log-in\"></span> Login</a></li></ul>";
                    echo $login_bar;
                } else {
                    $login_bar = "<ul class=\"nav navbar-nav navbar-right\"><li><a href=\"profile.php\">Hey</a></li></ul>";
                    echo $login_bar;
                }
            ?>   
        </div>
    </nav>
    <div id = "images">
        <a target = "_blank" href = "src/plane.jpg">
            <img src = "src/plane.jpg">
        </a>
        <a href = "car.php">
            <img src = "src/car.jpg">
        </a>
        <a target = "_blank" href = "src/parking.jpg">
            <img src = "src/parking.jpg">
        </a>
    </div>
    <div id="content">
        <form action="home.php" action="POST">
            <input class="input_text" name="search" placeholder="..."><input class="input_text" type="submit" name="search" value="Search"><br>
        </form>
        
        
    </div>
</body>
<script src="scripts/scripts.js"></script>
</html>