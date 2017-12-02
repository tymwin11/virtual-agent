<?php
    session_start();
    include('connect.php');
    ini_set('display_errors',1);
    if(isset($_POST['confirm'])){
        //$email = $_POST['email'];
        $email = "helloppl1116@gmail.com";
        $subject = "Tacocat Travels Confirmation";
        $body = "this test";
        //$body = "$name , \n Thank you for booking your trip with Tacocat Travels. \n Destination: $destination \n Seat: $seat \n Rental Car: $car \n Pre-Pay Parking: $parking";
        $mail = mail($email, $subject, $body);
        if($mail)
            echo "confirmation email sent";
        else
            echo "not sent";
    }
?>
<html>
    <head>
        <title>Checkout</title>
    </head>
    <body>
        <h1>Cart Checkout</h1>
        Card Number:<span id = result></span><br>
        <input onchange = "validate()" type = "number" id = "cardNum" size = "18" max = "9999999999999999"><br>
        Security Code:<br>
        <input type = "number" id = "security" size = "5" max = "999"><br>
        Name on card:<br>
        <input type = "text" id = "name" size = "15"><br>
        Expiration:<br>
        <input type = "month" id = "month" size = "4" max = "12"><br>
        Email:<br>
        <form method = "post">
            <input type = "text" name = "email">
            <input type = "submit" name = "confirm" value = "confirm"> 
        </form>
        <script>
            function validate(){
                var num = document.getElementById("cardNum").value;
                var master = /^(5[1-5]|22([3-9][0-9]|2[1-9])|2([3-6][0-9]{2}|7([0-1][0-9]|20)))/g;
                var visa = /^4/g;
                var american = /^3[47]/g;
                var discover = /^6([45]|011)/g;
                if(master.test(num))
                    document.getElementById("result").innerHTML = "<img width = '40' style = 'margin: auto' src = 'src/master.png'/>";
                else if(visa.test(num))
                    document.getElementById("result").innerHTML = "<img width = '40' style = 'margin: auto' src = 'src/visa.png'/>";
                else if(american.test(num))
                    document.getElementById("result").innerHTML = "<img width = '40' style = 'margin: auto' src = 'src/american.png'/>";
                else if(discover.test(num))
                    document.getElementById("result").innerHTML = "<img width = '40' style = 'margin: auto' src = 'src/discover.png'/>";
                else
                    document.getElementById("result").innerHTML = "";
            }
        </script>
    </body>
</html>