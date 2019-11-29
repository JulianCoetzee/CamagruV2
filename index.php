<?php

    require_once "config/setup.php";
    session_start() or die("Session Error");
    if (!isset($_SESSION['active_user']))
    {
        header("pages/dashboard.php");
    }

    // login
    // forgot pwd link - forgotpwd.php (require)
    // register link - registration.php (require)
    // 

?> 
<!-- <i class="fas fa-cheese"></i> -->
<!-- <i class="fas fa-key"></i> -->
<html>
    <head>
        <meta charset = utf-8>
        <title>Camagru Login</title>
        <link rel="stylesheet" href="http://use.fontawesome.com/releases/v5.7.1/css/all.css">
    </head>
    <body>
        <div class="login">
            <h1>Login</h1>
            <form action="authenticate.php" method="POST">
                <label for="username">
                    <i class="fas fa-cheese"></i>
                </label>
                <input type="text" name="Username" placeholder="Username" id="username" required><br />
                <label>
                    <i class="fas fa-key"></i>
                </label>
                <input type="password" name="Password" placeholder="Password" id="password" required><br />
                <button type="submit" name="login" value="Login">Login</button>
            </form>
            <a href="forgot.php">I forgot my keys!</a>
        </div>
        
        <?php
        
        if (! empty(htmlentities($_POST['username'])) and !empty(htmlentities($_POST['password'])) and $_POST['login'] == "OK")
        {
            $username = trim(htmlentities($_POST['username']));
            $passwd = htmlentities($_POST['password']);
            $conn = new Users($username, $password, "", "", "");
            $conn->connectUser();
            if ($conn->message)
              echo '<div style="color:red;">' . $conn->message . '</div>';
            else 
            {
              $_SESSION['active_user'] = $username;
            //   echo '<script> location.replace("../index.php"); </script>';
            }
        }
        ?>

    </body>
</html>