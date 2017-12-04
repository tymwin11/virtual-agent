
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
    session_destroy();
?>
<html>
    <head>
        <title>Logout</title>
    </head>
    <body>
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
            session_destroy();
            header("Location: home.php");
        ?>
    </body>
</html>

