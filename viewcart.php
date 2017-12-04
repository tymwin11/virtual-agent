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
            
            
            $query = "Select * from shoppingcart";
            $rs = mysql_query($query);

            if (!$rs) {
                echo "Could not execute query: $query";
                trigger_error(mysql_error(), E_USER_ERROR); 
            }  
            while ($row = mysql_fetch_assoc($rs)){
                $_SESSION['cart_count'] = $row['productid'];
            }
            echo "<div class='viewcart'>Cart: <a href='checkout.php'>".count($_SESSION['cart_count'])."</a></div>";
        ?>
    </body>
</html>
