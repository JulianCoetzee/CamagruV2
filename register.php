<?php

    require_once "config/setup.php";
    session_start() or die ("Session Error")

?>

<html>
    <head>
        <meta charset = utf8>
        <title>Camagru SignUp</title>
        <link rel="stylesheet" href="http://use.fontawesome.com/releases/v5.7.1/css/all.css">
    </head>
    <body>
        <div class="login">
            <h1>Sign Up</h1>
            <form action="authenticate.php" method="POST">
                <label for="username">
                    <i class="fas fa-cheese"></i>
                </label>
                <input type="text" name="Username" placeholder="Username" id="username" required><br />
                <input type="text" name="email" placeholder="E-mail" id="email" required><br />
                <label for="password">
                    <i class="fas fa-key"></i>
                </label>
                <input type="password" name="password" placeholder="Password" id="password" required><br />
                <input type="password" name="confirmpassword" placeholder=" Confirm Password" id="confirmpassword" required><br />
                <button type="submit" name="register" value="Sign Up">Sign Up</button>
            </form>
        </div>
    </body>
</html>