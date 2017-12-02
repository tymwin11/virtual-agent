<!DOCTYPE html>

<html>
    <head>
        <title>Booking Flight</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <style>
            label{
                background-color: black;
                color: white;
            }
        </style>
    </head>
    <body>
        <div>
            <div class="travel">
                <label class="roundtrip">Roundtrip</label>
                <label class="oneway">One Way</label>
                <label class="multicity">Multi-City</label>
            </div>
            <div>
                <form action="plane.php" method="post">
                    Flying from:<input type="text" value="City or airport" name="flying_from"> 
                    Flying to:<input type="text" value="City or airport" name="flying_to"><br>
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
                    <div class="multi-city">
                        <div>
                            <p>Flight 2</p>
                            Flying from:<input type="text" value="City or airport" name="flying_from"> 
                            Flying to:<input type="text" value="City or airport" name="flying_to"><br>
                            Departing:<input type="date" name="depart"><br>
                        </div>
                        <div>
                            <p>Flight 3</p>
                            Flying from:<input type="text" value="City or airport" name="flying_from"> 
                            Flying to:<input type="text" value="City or airport" name="flying_to"><br>
                            Departing:<input type="date" name="depart"><br>
                        </div>
                        <div>
                            <p>Flight 4</p>
                            Flying from:<input type="text" value="City or airport" name="flying_from"> 
                            Flying to:<input type="text" value="City or airport" name="flying_to"><br>
                            Departing:<input type="date" name="depart"><br>
                        </div>
                    </div>
                    <input type="submit" value="SUBMIT">
                </form>
            </div>
        </div>
        <script>
            $(document).ready(function(){
                $(".roundtrip").css("background-color","blue");
                $(".multi-city").hide();
                $(".oneway").click(function(){
                    $(".return").hide();
                    $(".multi-city").hide();
                    $(".oneway").css("background-color","blue");
                    $(".roundtrip").css("background-color","black");
                    $(".multicity").css("background-color","black");
                }); 
                $(".roundtrip").click(function(){
                    $(".return").show();
                    $(".multi-city").hide();
                    $(".multicity").css("background-color","black");
                    $(".oneway").css("background-color","black");
                    $(".roundtrip").css("background-color","blue");
                });
                $(".multicity").click(function(){
                   $(".return").hide();
                   $(".multi-city").show();
                   $(".multicity").css("background-color","blue");
                   $(".oneway").css("background-color","black");
                   $(".roundtrip").css("background-color","black");
               });
            });
        </script>
        <?PHP
            $fly_from = array();
            $fly_from[] = $_POST['flying_from'];
            $people = $_POST['num_people'];
            $date1 = date_create($_POST['departing']);
            $date2 = date_create($_POST['returning']);
            $diff = date_diff($date1, $date2);
            $sum = 100;
            $x = sizeof($fly_from);
            echo $x;
            if(x > 1){
                $sum = $sum * $x;
            }
            if($_POST['returning'] != null){
                $sum = $sum * 2;
            }
            $sum = $sum + $diff * 15;
            $sum = $sum * $people;   
            echo $sum;
        ?>
    </body>
</html>
