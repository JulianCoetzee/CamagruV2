<html>
    <head>
        <meta charset = utf-8>
        <title>Camagru Login</title>
        <link rel="stylesheet" href="http://use.fontawesome.com/releases/v5.7.1/css/all.css">
    </head>
    <body>
        <div class="login">
            <h2>Login</h2>
            <form action="../webphp/login.php" method="POST">
                <label for="username">
                    <i class="fas fa-cheese"></i>
                </label>
                <input type="text" name="Username" placeholder="Username" id="username" required><br />
                <label for=password>
                    <i class="fas fa-key"></i>
                </label>
                <input type="password" name="Password" placeholder="Password" id="password" required><br />
                <button type="submit" name="login" value="Login">Login</button>
            </form>
            <a href="forgot.php">I forgot my keys!</a>
        </div>
    </body>
</html>