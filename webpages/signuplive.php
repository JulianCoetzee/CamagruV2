<html>
    <head>
        <meta charset = utf-8>
        <link rel="shortcut icon" type="image/png" href="../cheese/cheese.ico"/>
        <title>Camagru SignUp</title>
        <link rel="stylesheet" href="http://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link rel="stylesheet" href="../css_html/form.css">
    </head>
    <body>
        <div class="camagru_header">
            Sign Up
        </div>
        <div class="formbox">
            <form action="../webphp/signup.php" method="POST">
                <label for="username">
                    <i class="fas fa-cheese"></i>
                </label>
                <input type="text" class="fieldbox" name="username" placeholder="Username" id="username" pattern="[a-zA-Z0-9]{6-30}" title="Your username should contain at least 6 characters including 1 UPPERCASE and 1 number and no special characters" required="" oninvalid="this.setCustomValidity('Correct cheese please')" oninput="this.setCustomValidity('')"><br />
                <label for="email">
                <i class="fas fa-envelope"></i>
                </label>
                <input type="text" class="fieldbox" name="email" placeholder="E-mail" id="email" required><br />
                <label for="password">
                    <i class="fas fa-key"></i>
                </label>
                <input type="password" class="fieldbox" name="password" placeholder="Password" id="password" pattern="[a-zA-Z0-9]{6-30}" title="Your password must contain at least 6 characters including 1 UPPERCASE and 1 number and no special characters" required="" oninvalid="this.setCustomValidity('Correct keys please')" oninput="this.setCustomValidity('')"><br />
                <label for="confirmpassword">
                    <i class="fas fa-key"></i>
                </label>
                <input type="password" class="fieldbox" name="confirmpassword" placeholder="Confirm Password" id="confirmpassword" pattern="[a-zA-Z0-9]{6-30}" title="Your password must contain at least 6 characters including 1 UPPERCASE and 1 number and no special characters" required="" oninvalid="this.setCustomValidity('Correct keys please')" oninput="this.setCustomValidity('')"><br />
                <button type="submit" class="formstuff" name="register" value="Sign Up">SignUp</button>
            </form>
        </div>
    </body>
</html>