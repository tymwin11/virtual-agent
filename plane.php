<?php
    session_start();
    include 'connect.php';
    include 'header.php';
?>

<html>
    <head>
        <title>Booking Flight</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link rel="stylesheet" href="styles/plane.css"/>
    </head>
    <body>
        <div class="booking">
            <div>
                <label class="roundtrip">Roundtrip</label>
                <label class="oneway">One Way</label>
            </div>
            <div>
                <form method="post">
                    Flying from:<select name="flying_from">
                        <option value="California">Los Angeles</option>
                        <option value="Atlanta">Atlanta</option>
                        <option value="Florida">Florida</option>
                        <option value="Seattle">Seattle</option>
                    </select><br>
                    Flying to:<select name="flying_to">
                        <option value="California">Los Angeles</option>
                        <option value="Atlanta">Atlanta</option>
                        <option value="Florida">Florida</option>
                        <option value="Seattle">Seattle</option>
                    </select><br>
                    Departing:<input type="date" name="departing"><br>
                    <div class="return">
                        Returning:<input type="date" name="returning">
                    </div>
                    <input type="submit" value="Submit" name="submit">
                </form>
            </div>
        </div>
        <?php
            if(isset($_POST['submit'])){
                $_SESSION['from'] = $_POST['flying_from'];
                $_SESSION['to'] = $_POST['flying_to'];
                $date1=date_create($_POST['departing']);
                $date2=date_create($_POST['returning']);
                $diff=date_diff($date1,$date2);
                $days = $diff->format("%a");
                $_SESSION['dep_date'] = date_format($date1, "m/d/Y");
                $_SESSION['arr_date'] = date_format($date2, "m/d/Y");
                $query = "insert into flight(departure_city, arrival_city, departure_date, arrival_date) values('".$_SESSION['from']."','".$_SESSION['to']."','".$_SESSION['dep_date']."','".$_SESSION['arr_date']."')";
                $rs = mysql_query($query);
                    if (!$rs) {
                        echo "query could not be executed";
                        trigger_error(mysql_error(), E_USER_ERROR); 
                    }
                $_SESSION['price'] = 100 + $days * 15;
            
                $query = "select * from flight";
                $rs = mysql_query($query);
                    if (!$rs) {
                        echo "query could not be executed";
                        trigger_error(mysql_error(), E_USER_ERROR); 
                    }
                while($row = mysql_fetch_assoc($rs)){
                    $_SESSION['flightid'] = $row['flightid'];
                }
                $query = "select * from time where flightid = 1";
                $rs = mysql_query($query);
                if (!$rs) {
                    echo "query could not be executed";
                    trigger_error(mysql_error(), E_USER_ERROR); 
                }
                $i=0;
                while($row = mysql_fetch_assoc($rs)){
                    $_SESSION['dep_time'] = $row['depareture_time'];
                    $_SESSION['arr_time'] = $row['arrival_time'];
                    $i++;
                }
                $query = "select * from seat where flightid = 1 and timeid = 1";
                $rs = mysql_query($query);
                    if (!$rs) {
                        echo "query could not be executed";
                        trigger_error(mysql_error(), E_USER_ERROR); 
                    }
                    $x=0;
                    while($row = mysql_fetch_assoc($rs)){
                    $seat_number[$x] = $row['seatnumber'];
                    $x++;
                }
            }
            ?>
        <div class="flights">
            <table>
                <caption style="font-size: 25px;">Departure Flight</caption>
                <tr>
                    <th>Date</th>
                    <th>Departure Time</th>
                    <th>Arrival Time</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Price</th>
                </tr>
                <tr>
                    <td><?php echo $_SESSION['dep_date']; ?></td>
                    <td><?php echo $_SESSION['dep_time']; ?></td>
                    <td><?php echo $_SESSION['arr_time']; ?></td>
                    <td><?php echo $_SESSION['from']; ?></td>
                    <td><?php echo $_SESSION['to']; ?></td>
                    <td><?php echo $_SESSION['price']; ?></td>
                </tr>
            </table>
            <div class="return">
            <table>
                <caption style="font-size: 25px;">Return Flights</caption>
                <tr>
                    <th>Date</th>
                    <th>Departure Time</th>
                    <th>Arrival Time</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Price</th>
                </tr>
                <tr>
                    <td><?php echo $_SESSION['arr_date']; ?></td>
                    <td><?php echo $_SESSION['dep_time']; ?></td>
                    <td><?php echo $_SESSION['arr_time']; ?></td>
                    <td><?php echo $_SESSION['to']; ?></td>
                    <td><?php echo $_SESSION['from']; ?></td>
                    <td><?php echo $_SESSION['price']; ?></td>
                </tr>
            </table>
                <form method="post">
                    Available Depature Seats:<select name="seat_dep">
                    <?php
                        $i=0; 
                        while($i <= $x){
                            echo "<option value=\"'$seat_number[$i]'\">".$seat_number[$i]."</option>";
                            $i++;
                        } 
                    ?>
                    </select>
                    Available Arrival Seats:<select name="seat_arr">
                    <?php
                        $i=0;
                        while($i <= $x){
                            echo "<option value=\"'$seat_number[$i]'\">".$seat_number[$i]."</option>";
                            $i++;
                        }
                    ?>
                    </select><br>
                    <input type="submit" value="Add to Cart" name="addtocart">
                    <?php 
                        if(isset($_POST['addtocart'])){
                            $seatdep = $_POST['seat_dep'];
                            $seatarr = $_POST['seat_arr'];
                            $plane_inventory1 = $_SESSION['dep_date']." ".$_SESSION['from']." ".$_SESSION['to']." ".$_SESSION['dep_time']." ".$_SESSION['arr_time']." Seat: '$seatdep'";
                            $plane_inventory2 = $_SESSION['arr_date']." ".$_SESSION['to']." ".$_SESSION['from']." ".$_SESSION['dep_time']." ".$_SESSION['arr_time']." Seat: '$seatarr'";
                            $query = "insert into inventory(name,price,quantity) values('".$plane_inventory1."',".$_SESSION['price'].",1)";
                            $rs = mysql_query($query);
                            if (!$rs) {
                                echo "query could not be executed";
                                trigger_error(mysql_error(), E_USER_ERROR); 
                            }
                            $query = "select * from inventory";
                            $rs = mysql_query($query);
                            if (!$rs) {
                                echo "query could not be executed";
                                trigger_error(mysql_error(), E_USER_ERROR); 
                            }
                            while($row = mysql_fetch_assoc($rs)){
                                $_SESSION['productid'] = $row['productid'];
                            }
                            $query = "insert into shoppingcart(customerid, productid, product_quantity, product_price) values(".$_SESSION['user_id'].", ".$_SESSION['productid'].",1,".$_SESSION['price'].")";
                            $rs = mysql_query($query);
                            if (!$rs) {
                                echo "query could not be executed";
                                trigger_error(mysql_error(), E_USER_ERROR); 
                            }
                            $query = "insert into inventory(name,price,quantity) values('".$plane_inventory2."',".$_SESSION['price'].",1)";
                            $rs = mysql_query($query);
                            if (!$rs) {
                                echo "query could not be executed";
                                trigger_error(mysql_error(), E_USER_ERROR); 
                            }
                            $query = "select * from inventory";
                            $rs = mysql_query($query);
                            if (!$rs) {
                                echo "query could not be executed";
                                trigger_error(mysql_error(), E_USER_ERROR); 
                            }
                            while($row = mysql_fetch_assoc($rs)){
                                $_SESSION['productid'] = $row['productid'];
                            }
                            $query = "insert into shoppingcart(customerid, productid, product_quantity, product_price) values(".$_SESSION['user_id'].", ".$_SESSION['productid'].",1,".$_SESSION['price'].")";
                            $rs = mysql_query($query);
                            if (!$rs) {
                                echo "query could not be executed";
                                trigger_error(mysql_error(), E_USER_ERROR); 
                            }
                        }
                    ?>
                </form>    
            </div>
        </div>
        <script>
            $(document).ready(function(){
                $(".roundtrip").css("background-color","blue");
                $(".oneway").click(function(){
                    $(".return").hide();
                    $(".oneway").css("background-color","blue");
                    $(".roundtrip").css("background-color","gray");
                }); 
                $(".roundtrip").click(function(){
                    $(".return").show();
                    $(".oneway").css("background-color","gray");
                    $(".roundtrip").css("background-color","blue");
                });
            });
        </script>
    </body>
</html>
