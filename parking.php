<?php
    session_start();
    include('connect.php');
    include('header.php');
    if(isset($_POST['submit'])){
        $type = $_POST['section'];
        $customerid = $_SESSION['user_id'];
        $fee = $type . " Fee";
        $sql = "SELECT productid, price, quantity FROM inventory WHERE name = '$fee'";
        $result = mysql_query($sql);
        if (mysql_num_rows($result) > 0) {
            while($row = mysql_fetch_assoc($result)) {
                $productid = $row["productid"];
                $product_price = $row["price"];
                $product_quantity = $row["quantity"];
            }
        } 
        else {
            //echo "0 results";
        }
        $sql = "INSERT INTO shoppingcart VALUES($customerid, $productid, 1, $product_price)";
        $rs = mysql_query($sql);
        if (!$rs) {
            echo "Could not execute query: $sql";
            trigger_error(mysql_error(), E_USER_ERROR); 
        }
        $product_quantity-=1;
        $sql = "UPDATE inventory SET quantity = $product_quantity WHERE productid = $productid";
        $rs = mysql_query($sql);
        if (!$rs) {
            echo "Could not execute query: $sql";
            trigger_error(mysql_error(), E_USER_ERROR); 
        }
        //DATE
        $date1=date_create($_POST['leave_day']);
        $date2=date_create($_POST['return_day']);
        $diff=date_diff($date1,$date2);
        $days = $diff->format("%a");
        $daily = $type . " Per Day";
        $sql = "SELECT productid, price, quantity FROM inventory WHERE name = '$daily'";
        $result = mysql_query($sql);
        if (mysql_num_rows($result) > 0) {
            while($row = mysql_fetch_assoc($result)) {
                $productid = $row["productid"];
                $product_price = $row["price"];
                $product_quantity = $row["quantity"];
            }
        } 
        else {
            //echo "0 results";
        }
        $product_price *= $days;
        $sql = "INSERT INTO shoppingcart VALUES($customerid, $productid, $days, $product_price)";
        $rs = mysql_query($sql);
        if (!$rs) {
            echo "Could not execute query: $sql";
            trigger_error(mysql_error(), E_USER_ERROR); 
        }
        $product_quantity -= $days;
        $sql = "UPDATE inventory SET quantity = $product_quantity WHERE productid = $productid";
        $rs = mysql_query($sql);
        if (!$rs) {
            echo "Could not execute query: $sql";
            trigger_error(mysql_error(), E_USER_ERROR); 
        }
    }
?>
<html>
    <head>
        <title>Parking</title>
        <style>
            .parking{
                background-color: rgb(29,29,29);
                color: white;
                width: 100%;
                padding: 25px;
            }
            input, select{
                border-radius: 5px;
                padding: 5px;
                margin-top: 10px;
                color: black;
            }
            h1{
                border: 12px inset grey;
                background-color:darkgrey;
                margin: 10px;
                text-align: center;
                color:black;
                text-shadow: 1px 1px 2px white, 0 0 25px white, 0 0 5px white;
                padding: 20px;
                font-size: 60px;
                font-family: Comic;
                font-style: bold;
            }
        </style>
    </head>
    <body>
        <div class = "parking">
            <h1>Pre-Pay Parking</h1>
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
                Select Parking Section<select name = "section">
                    <option value = "Regular Parking">Regular</option>
                    <option value = "VIP Parking">VIP</option>
                </select><br>
                <input type = "submit" value = "Add to Cart" name = "submit"/>
            </form>
        </div>
    </body>
</html>
