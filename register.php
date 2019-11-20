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
                <input type="text" name="Username" placeholder="Username" id="username" pattern="[a-zA-Z0-9]{6-30}" title="Your username should contain at least 6 characters including 1 UPPERCASE and 1 number and no special characters" required="" oninvalid="this.setCustomValidity('Correct cheese please')" oninput="this.setCustomValidity('')">><br />
                <input type="text" name="email" placeholder="E-mail" id="email" required><br />
                <label for="password">
                    <i class="fas fa-key"></i>
                </label>
                <input type="password" name="password" placeholder="Password" id="password" pattern="[a-zA-Z0-9]{6-30}" title="Your password must contain at least 6 characters including 1 UPPERCASE and 1 number and no special characters" required="" oninvalid="this.setCustomValidity('Correct keys please')" oninput="this.setCustomValidity('')"><br />
                <input type="password" name="confirmpassword" placeholder=" Confirm Password" id="confirmpassword" pattern="[a-zA-Z0-9]{6-30}" title="Your password must contain at least 6 characters including 1 UPPERCASE and 1 number and no special characters" required="" oninvalid="this.setCustomValidity('Correct keys please')" oninput="this.setCustomValidity('')"><br />
                <button type="submit" name="register" value="Sign Up">Sign Up</button>
            </form>
        </div>
    </body>
</html>