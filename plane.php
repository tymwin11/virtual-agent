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
                $from = $_POST['flying_from'];
                $to = $_POST['flying_to'];
                $date1=date_create($_POST['departing']);
                $date2=date_create($_POST['returning']);
                $diff=date_diff($date1,$date2);
                $days = $diff->format("%a");
                $dep_date =date_format($date1, "m/d/Y");
                $arr_date = date_format($date2, "m/d/Y");
                $query = "insert into flight(departure_city, arrival_city, departure_date, arrival_date) values('".$from."','".$to."','".$dep_date."','".$arr_date."')";
                $rs = mysql_query($query);
                    if (!$rs) {
                        echo "query could not be executed";
                        trigger_error(mysql_error(), E_USER_ERROR); 
                    }
                $price = 100 + $days * 15;
                $price2 = 100 + $days * 15;
            }
                $query = "select * from flight";
                $rs = mysql_query($query);
                    if (!$rs) {
                        echo "query could not be executed";
                        trigger_error(mysql_error(), E_USER_ERROR); 
                    }
                while($row = mysql_fetch_assoc($rs)){
                    $flightid = $row['flightid'];
                }
                $query = "select * from time where flightid = 1";
                $rs = mysql_query($query);
                    if (!$rs) {
                        echo "query could not be executed";
                        trigger_error(mysql_error(), E_USER_ERROR); 
                    }
                    while($row = mysql_fetch_assoc($rs)){
                    $dep_time[$i] = $row['depareture_time'];
                    $arr_time[$i] = $row['arrival_time'];
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
                    <td><?php echo $dep_date ?></td>
                    <td><?php echo $dep_time[0] ?></td>
                    <td><?php echo $arr_time[0] ?></td>
                    <td><?php echo $from ?></td>
                    <td><?php echo $to ?></td>
                    <td><?php echo $price ?></td>
                </tr>
            </table>
            Available Seats:<select name="seat_dep">
            <?php
                $i=0; 
                while($i <= $x){
                    echo "<option value=\"'.$seat_number[$i].'\">".$seat_number[$i]."</option>";
                    $i++;
                } 
            ?>
            </select>
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
                     <td><?php echo $arr_date ?></td>
                    <td><?php echo $dep_time[0] ?></td>
                    <td><?php echo $arr_time[0] ?></td>
                    <td><?php echo $to ?></td>
                    <td><?php echo $from ?></td>
                    <td><?php echo $price2 ?></td>
                </tr>
            </table>
                <form method="post">
                    Available Seats:<select name="seat_arr">
                    <?php
                        $i=0;
                        $cancel[$i];
                        while($i <= $x){
                            echo "<option value=\"'.$seat_number[$i].'\">".$seat_number[$i]."</option>";
                            $i++;
                        }
                        $plane_inventory1 = $from."-".$to." ".$date1." ".$dep_time."-".$arr_time." Seat:".$_POST['seat_dep'];
                        $plane_inventory2 = $to."-".$from." ".$date2." ".$dep_time."-".$arr_time." Seat:".$_POST['seat_arr'];
                        echo $plane_inventory1;
                        echo $plane_inventory2;
                    ?>
                    </select>
                    <input type="submit" value="Add to Cart" name="addtocart">
                </form>    
            </div>
        </div>
        <script>
            $(document).ready(function(){
                $(".oneway").css("background-color","blue");
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
