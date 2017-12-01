<?php
    session_start();
    include('connect.php');
    $type = $_POST['type'];
    if(isset($_POST['submit'])){
        $sql = "UPDATE admin SET car = '$type' where user = ''";
        $rs = mysql_query($sql);
        if (!$rs) {
            echo "Could not execute query: $query";
            trigger_error(mysql_error(), E_USER_ERROR); 
        }
        $rs = mysql_query($query);
        mysql_close();
    }
?>
<html>
    <head>
        <title>Car Rental</title>
    </head>
    <body>
        <h1>Car Rental</h1>
        <form method = "POST">
            <p>Select Car Type<select name = "type">
                <option value = "SUV">SUV</option>
                <option value = "Compact">Compact</option>
                <option value = "Midsize">Midsize</option>
                <option value = "Luxury">Luxury</option>
            </select></p>
            <p><input type = "submit" value = "Add to Cart" name = "submit"/></p>
        </form>
    </body>
</html>