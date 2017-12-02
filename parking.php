<?php
    session_start();
    include('connect.php');
    $type = $_POST['type'];
    $query = "SELECT * FROM users";
    $rs = mysql_query($query);
    if (!$rs) {
        echo "Could not execute query: $query";
        trigger_error(mysql_error(), E_USER_ERROR); 
    }
    while ($row = mysql_fetch_assoc($rs)){
        $_SESSION['user'] = $row['login'];
    }
    $user_session = $_SESSION['user'];
    if(isset($_POST['submit'])){
        $sql = "UPDATE admin SET car = $type where user = $user_session";
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
        <title>Parking</title>
    </head>
    <body>
        <h1>Pre-Paying Parking</h1>
        <div>Welcome <?PHP echo '$user_session';?></div>
        <form method = "POST">
            Leaving<input type = "date" name = "leave_day">
            <select name="times">
                <?php 
                $start = strtotime('12:00');
                $end   = strtotime('24:00');
                for ($i=$start; $i<=$end; $i = $i + 30*60){
                echo '<option>'.date('g:i A',$i).'</option>';
                }
                ?>
            </select><br>
            Returning<input type = "date" name = "return_day">
            <select name="times">
                <?php 
                $start = strtotime('12:00');
                $end   = strtotime('24:00');
                for ($i=$start; $i<=$end; $i = $i + 30*60){
                echo '<option>'.date('g:i A',$i).'</option>';
                }
                ?>
            </select><br>
            <input type = "submit" value = "Add to Cart" name = "submit"/>
        </form>
    </body>
</html>