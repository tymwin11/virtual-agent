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
            $host = "localhost"; 
            $user = "tnguyen366"; 
            $pass = "tnguyen366"; 
            $db = "tnguyen366";
            $i = 0;
            $r = mysql_connect($host, $user, $pass);
            if (!$r) {
                echo "Could not connect to server\n";
                trigger_error(mysql_error(), E_USER_ERROR);
            }
            $r2 = mysql_select_db($db);
            if (!$r2) {
                echo "Cannot select database\n";
                trigger_error(mysql_error(), E_USER_ERROR);
            }
            
            $query = "Select shoppingcart.customerid, shoppingcart.date_initialized, shoppingcart_items.productid, shoppingcart_items.product_quantity, shoppingcart_items.product_price FROM shoppingcart, shoppingcart_items WHERE shoppingcart.cartid = shoppingcart_items.cartid";
            $rs = mysql_query($query);

            if (!$rs) {
                echo "Could not execute query: $query";
                trigger_error(mysql_error(), E_USER_ERROR); 
            }  
            while ($row = mysql_fetch_assoc($rs)){
                $cart_count[$i] = $row['cartid'];
                $i++;
            echo $row['customerid']." ".$row['date_initialized']." ".$row['productid']." ".$row['product_quantity']." ".$row['product_price'];
            }
            echo "<div class='viewcart'> Cart: <a href='#shoppingcart.php'>".count($cart_count)."</a></div>";
        ?>
    </body>
</html>
