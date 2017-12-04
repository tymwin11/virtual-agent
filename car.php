<?php
    session_start();
    include('connect.php');
    include('viewcart.php');
    include('header.php');
    if(isset($_POST['submit'])){
        $type = $_POST['type'];
        $customerid = $_SESSION['user_id'];
        $sql = "SELECT productid, price, quantity FROM inventory WHERE name = '$type'";
        $result = mysql_query($sql);
        if (mysql_num_rows($result) > 0) {
            while($row = mysql_fetch_assoc($result)) {
                $productid = $row["productid"];
                $product_price = $row["price"];
                $product_quantity = $row["quantity"];
            }
        } 
        else {
            echo "0 results";
        }
        $sql = "INSERT INTO shoppingcart VALUES($customerid, $productid, $product_quantity, $product_price)";
        $rs = mysql_query($sql);
        if (!$rs) {
            echo "Could not execute query: $sql";
            trigger_error(mysql_error(), E_USER_ERROR); 
        }
    }
?>
<html>
    <head>
        <title>Car Rental</title>
        <style>
            .renting{
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
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class = "renting">
            <h1>Car Rental</h1>
            <form method = "post">
                Select Car Type<select name = "type">
                    <option value = "SUV Fee">SUV</option>
                    <option value = "Compact Fee">Compact</option>
                    <option value = "Midsize Fee">Midsize</option>
                    <option value = "Luxury Fee">Luxury</option>
                </select><br>
                Pickup<input type = "date" name = "pickup"><br>
                Dropoff<input type = "date" name = "dropoff"><br>
                <input type = "submit" value = "Add to Cart" name = "submit"/>
            </form>
        </div>
    </body>
</html>
<?php 
$date1=date_create($_POST['pickup']);
$date2=date_create($_POST['dropoff']);
$diff=date_diff($date1,$date2);
$days = $diff->format("%a");
echo $days;
?>
