<?php

    require_once "config/setup.php";
    session_start() or die("Session Error");

?> 
<!-- <i class="fas fa-cheese"></i> -->
<!-- <i class="fas fa-key"></i> -->
<html>
    <head>
        <meta charset = utf8>
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
        </div>
    </body>
</html>