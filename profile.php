<!DOCTYPE html>

<html>
    <head>
        <title>Profile</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            .panel{
                border: 1px black solid;
                width: 50%;
                text-align: center;
                margin: auto;
                margin-top: 25px;
                margin-bottom: 25px;
            }
            .panelheader{
                font-size: 20px;
                border-bottom: 1px black solid;
                background-color: lightgray;
                margin-top: 0px;
            }
            .inputbox{
                width: 40%;
                font-size: 15px;
                margin: 0px 0px 15px 10px; 
            }
            .birthdate{
                font-size: 15px;
                margin: 0px 0px 15px 10px; 
            }
            table{
                margin: auto;
            }
            tr, td{
                font-size: 15px;
            }
        </style>
    </head>
    <body>
        <?PHP 
            session_start();
            include('connect.php');
            include('header');
            $query1 = "SELECT * FROM users";
            $rs = mysql_query($query1);
            if (!$rs) {
                echo "Could not execute query: $query1";
                trigger_error(mysql_error(), E_USER_ERROR); 
            }
            while ($row = mysql_fetch_assoc($rs)){
                $_SESSION['user_id'] = $row['customerid'];
                $_SESSION['user_first'] = $row['firstname'];
                $_SESSION['user_last'] = $row['lastname'];
                $_SESSION['user_address'] = $row['address'];
            }
            $query2 = "SELECT * FROM orders";
            $rs = mysql_query($query2);
            if (!$rs) {
                echo "Could not execute query: $query2";
                trigger_error(mysql_error(), E_USER_ERROR); 
            }
            while ($row = mysql_fetch_assoc($rs)){
                $_SESSION['order_id'] = $row['orderid'];
                $_SESSION['order_status'] = $row['status'];
                $_SESSION['date'] = $row['date_purchased'];
            }
        ?> 
        <div class="panel">
            <h1 class="panelheader">Personal Information</h1>
            Customer ID#:<input class="inputbox" value="<?PHP echo $_SESSION['user_id']?>"><br>
            First Name:<input class="inputbox" value="<?PHP echo $_SESSION['user_first']?>"><br>
            Last Name:<input class="inputbox" value="<?PHP echo $_SESSION['user_last']?>"><br>
            Address:<input class="inputbox" value="<?PHP echo $_SESSION['user_adress']?>"><br>
        </div>
        <div class="panel">
            <h2 class="panelheader">Past Purchases</h2>
            <table>
                <tr>
                    <th><?PHP echo $_SESSION['order_id']?></th>
                    <th><?PHP echo $_SESSION['order_status']?></th>
                    <th><?PHP echo $_SESSION['date']?></th>
                </tr>
            </table>
        </div>
    </body>
</html>
