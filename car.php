<?php
    session_start();
    include('connect.php');
    include('viewcart.php');
    include('header.php');
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
        $sql = "UPDATE shoppingcart SET car = $type where user = ".$_SESSION['user'];
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
            <form method = "POST">
                Select Car Type<select name = "type">
                    <option value = "SUV">SUV</option>
                    <option value = "Compact">Compact</option>
                    <option value = "Midsize">Midsize</option>
                    <option value = "Luxury">Luxury</option>
                </select><br>
                Pickup<input type = "date" name = "pickup"><br>
                Dropoff<input type = "date" name = "dropoff"><br>
                <input type = "submit" value = "Add to Cart" name = "submit"/>
            </form>
        </div>
    </body>
</html>
