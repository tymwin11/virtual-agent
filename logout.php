<?php
    session_start();
    include 'connect.php';
    include 'header.php';
    session_unset();
?>
<html>
    <head>
        <title>Logout</title>
    </head>
    <body>
        <h1>You've Logged Out</h1>
    </body>
</html>
<?php
    session_destroy();
?>
