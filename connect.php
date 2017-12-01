<?php
    $host = "localhost";
    $test = "pphejlada1";
    // $test = "tnguyen366";
    
    $user = $test; 
    $pass = $test;
    $db = $test;
    $r = mysql_connect($host, $user, $pass);
    
    if (!$r) {
        // echo "Could not connect to server<br>";
        trigger_error(mysql_error(), E_USER_ERROR);
    } else {
        // echo "Connection established<br>"; 
    }
    $r2 = mysql_select_db($db);
    if (!$r2) {
        // echo "Cannot select database<br>";
        trigger_error(mysql_error(), E_USER_ERROR);
    } else {
        // echo "Database selected<br>";
    }
?>