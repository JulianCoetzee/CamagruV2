<?php

    require_once "location: config/setup.php";
    start_session() or die("Session Error");

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
                <input type="text" name="Username" placeholder="Username" id="username" required>
                <label>
                    <i class="fas fa-key"></i>
                </label>
                <input type="password" name="Password" placeholder="Password" id="password" required>
                <button type="submit" name="login" value="Login">Login</button>
            </form>
        </div>
    </body>
</html>