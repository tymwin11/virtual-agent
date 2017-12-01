<?php
    session_start();
    $test = "pphejlada1";
    // $test = "tnguyen366";
    if(isset($_POST['submit'])){
        $db = new mysqli("localhost", $test, $test, $test);
        $query = "SELECT * FROM admin WHERE user = '" . $_POST['user'] . "' AND pass = '" . $_POST['pass'] . "'";
        $sql = $db->query($query);
        $n = $sql->num_rows;
        if($n > 0)
            header("Location: home.php");
        else
            $error = "Invalid login username or password";
    }
    if(isset($_POST['register'])){
        $db = new mysqli("localhost", $test, $test, $test);
        $sql = "INSERT INTO admin(user, pass) VALUES ('". $_POST['user'] . "','" . $_POST['pass'] . "')";
        $rs = $db->query($sql);
        if($rs)
            $error = "User Successfully Created";
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
        <h1>Login to Music Base</h1>
        <form method = "POST">
            <div class="login">
              <label><b>Username</b></label>
              <input type="text" placeholder="Enter Username" name="user" required><br>
          
              <label><b>Password</b></label>
              <input type="password" placeholder="Enter Password" name="pass" required><br>
          
              <button type = "submit" name = "submit">Login</button>
              <button type = "submit" name = "register">Register</button>
              <div class = "error"><?php echo $error; ?></div>
            </div>
        </form>
    </body>
</html>