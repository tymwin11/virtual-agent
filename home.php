<?php
    session_start();
    include('connect.php');
    include('header.php');
?>
<html>
<head>
    <title>Tacocat Travel Agency - Home</title>
    <link rel="stylesheet" href="styles/home.css"/>
</head>
<body>
    
    <div id = "images">
        <a href = "plane.php">
            <img src = "src/plane.jpg">
        </a>
        <a href = "car.php">
            <img src = "src/car.jpg">
        </a>
        <a href = "parking.php">
            <img src = "src/parking.jpg">
        </a>
    </div>
</body>
<script src="scripts/scripts.js"></script>
</html>
