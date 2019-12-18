<html>
    <head>
        <meta charset = utf-8>
        <link rel="shortcut icon" type="image/png" href="../cheese/cheese.ico"/>
        <title>Camagru Login</title>
        <link rel="stylesheet" href="http://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link rel="stylesheet" href="../css_html/form.css">
        <link rel="stylesheet" href="../css_html/layout.css">
    </head>
    <body>
        <div class="camagru_header">
            Login
        </div>
        <div class="formbox">
            <form action="../webphp/login.php" method="POST">
                <label for="username">
                    <i class="fas fa-cheese"></i>
                </label>
                <input type="text" name="username" placeholder="Username" id="username" class="fieldbox" required><br />
                <label for=password>
                    <i class="fas fa-key"></i>
                </label>
                <input type="password" name="password" placeholder="Password" id="password" class="fieldbox" required><br />
                <button type="submit" name="login" class="formstuff" value="Login">Login</button>
            </form>
            <a href="resetrequestlive.php">I forgot my keys!</a><br />
            <a href="signuplive.php">I'm new!</a>
            
        </div>
    </body>
</html>