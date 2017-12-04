<?php
    session_start();
    include('connect.php');
    include('header.php');
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
    
    <div id = "images">
        <a href = "plane.php">
            <img src = "src/plane.jpg">
        </a>
        <a href = "car.php">
            <img src = "src/car.jpg">
        </a>
        <a href = "park.php">
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
