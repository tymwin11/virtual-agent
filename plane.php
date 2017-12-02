<?php
    session_start();
    include 'connect.php';
    include 'header.php';
?>
<!DOCTYPE html>

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
                    People:<select name="num_people">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                    </select><br>
                    <input type="submit" value="Submit">
                </form>
            </div>
        </div>
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
                    <td>12/12/2017</td>
                    <td>10:00</td>
                    <td>12:00</td>
                    <td>Los Angeles</td>
                    <td>Atlanta</td>
                    <td>150</td>
                </tr>
            </table>
            
            <table class="return">
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
                     <td>12/19/2017</td>
                    <td>1:00</td>
                    <td>2:00</td>
                    <td>Atlanta</td>
                    <td>Los Angeles</td>
                    <td>150</td>
                </tr>
            </table>
        </div>
        <script>
            $(document).ready(function(){
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
