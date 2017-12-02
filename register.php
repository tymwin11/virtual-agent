<?php
    session_start();
    $test = "pphejlada1";
    // $test = "tnguyen366";
    if(isset($_POST['register'])){
        $db = new mysqli("localhost", $test, $test, $test);
        $address = $_POST['address1'] . " " . $_POST['address2'];
        $query = "INSERT INTO users(login, password, firstname, lastname, address) VALUES ('". $_POST['user'] . "','" . $_POST['pass'] . "','" . $_POST['first'] . "','" . $_POST['last'] . "','" . $address . "')";
        $sql = $db->query($query);
        $query2 = "INSERT INTO shoppingcart(customerid) SELECT customerid FROM users";
        $sql2 = $db->query($query2);
        if($sql && $sql2)
            header("Location: home.php");
        else
            $error = "Error: User not created";
    }
?>
<html>
    <head>
        <title>Login</title>
        <style>
            body{
                background-color: paleturquoise;
                text-align: center;
            }
            .login{
                text-align: center;
                background-color: white;
                width: 300px;
                border: solid 1px black;
                margin: 0 auto;
                padding: 10px;
            }
            .error{
                color: red;
            }
        </style>
    </head>
    <body>
        <h1>Create an Account</h1>
        <form method = "POST">
            <div class="login">
              <label><b>Username</b></label>
              <input type="text" placeholder="Enter Username" name="user" required><br>
              <label><b>Password</b></label>
              <input type="password" placeholder="Enter Password" name="pass" required><br>
              <label><b>First Name</b></label>
              <input type="text" placeholder="Enter First Name" name="first" required><br>
              <label><b>Last Name</b></label>
              <input type="text" placeholder="Enter Last Name" name="last" required><br>
              <label><b>Address</b></label>
              <input type="text" placeholder="Enter Address" name="address1" required><br>
              <input type="text" placeholder="Enter City, State, Zipcode" name="address2" required><br>
              <button type = "submit" name = "register">Register</button>
              <div class = "error"><?php echo $error; ?></div>
            </div>
        </form>
    </body>
</html>
