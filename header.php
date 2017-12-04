<?php
    session_start();
    include('connect.php');
?>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>Tacocat Travel Agency - Home</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
                    <li><a href="plane.php">Flights</a></li>
                    <li><a href="car.php">Rentals</a></li>
                    <li><a href="parking.php">Parking</a></li>
                    </ul>
                </li>
            </ul>
            <?php
                include('viewcart.php');
                if ($_SESSION['id'] == null) {
                    $login_bar = "<ul class=\"nav navbar-nav navbar-right\"><li><a href=\"register.php\"><span class=\"glyphicon glyphicon-user\"></span> Sign Up</a></li><li><a href=\"login.php\"><span class=\"glyphicon glyphicon-log-in\"></span> Login</a></li></ul>";
                    echo $login_bar;
                } else {
                    $login_bar = "<ul class=\"nav navbar-nav navbar-right\"><li><a href=\"profile.php\">Hey ".$_SESSION['user_first']."</a></li><li><a href=\"logout.php\">Sign out</a></li></ul>";
                    echo $login_bar;
                }
            ?>   
        </div>
    </nav>
</body>
<script src="scripts/scripts.js"></script>
</html>
