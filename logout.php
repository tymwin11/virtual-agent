<?php
    session_start();
    include 'connect.php';
    include 'header.php';
    $sql = "TRUNCATE table shoppingcart";
    $rs = mysql_query($sql);
    if (!$rs) {
        echo "Could not execute query: $sql";
        trigger_error(mysql_error(), E_USER_ERROR); 
    }
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
