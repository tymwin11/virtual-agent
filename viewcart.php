<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
            .viewcart{
                float: right;
                text-decoration: none;
            }
        </style>    
    </head>
    <body>
        <?php
            session_start();
            include('connect.php');
            
            if ($_SESSION['signin']){
            $query = "Select * from shoppingcart where customerid =".$_SESSION['user_id'];
            $rs = mysql_query($query);

            if (!$rs) {
                echo "Could not execute query: $query";
                trigger_error(mysql_error(), E_USER_ERROR); 
            }
            }
            $i = 0;
            $_SESSION['cartcount']=0;
            while ($row = mysql_fetch_assoc($rs)){
                $i++;
                $_SESSION['cartcount'] = $i;
            }
            echo "<div class='viewcart'>Cart: <a href='checkout.php'>".$_SESSION['cartcount']."</a></div>";
        ?>
    </body>
</html>
