<html>
    <head>
        <meta charset = utf-8>
        <title>Camagru SignUp</title>
        <link rel="stylesheet" href="http://use.fontawesome.com/releases/v5.7.1/css/all.css">
    </head>
    <body>
        <div>
            <h2>Sign Up</h2 >
            <form action="../signup.php" method="POST">
                <label for="username">
                    <i class="fas fa-cheese"></i>
                </label>
                <input type="text" name="username" placeholder="Username" id="username" pattern="[a-zA-Z0-9]{6-30}" title="Your username should contain at least 6 characters including 1 UPPERCASE and 1 number and no special characters" required="" oninvalid="this.setCustomValidity('Correct cheese please')" oninput="this.setCustomValidity('')"><br />
                <label for="email">
                <i class="fas fa-envelope"></i>
                </label>
                <input type="text" name="email" placeholder="E-mail" id="email" required><br />
                <label for="password">
                    <i class="fas fa-key"></i>
                </label>
                <input type="password" name="password" placeholder="Password" id="password" pattern="[a-zA-Z0-9]{6-30}" title="Your password must contain at least 6 characters including 1 UPPERCASE and 1 number and no special characters" required="" oninvalid="this.setCustomValidity('Correct keys please')" oninput="this.setCustomValidity('')"><br />
                <label for="confirmpassword">
                    <i class="fas fa-key"></i>
                </label>
                <input type="password" name="confirmpassword" placeholder=" Confirm Password" id="confirmpassword" pattern="[a-zA-Z0-9]{6-30}" title="Your password must contain at least 6 characters including 1 UPPERCASE and 1 number and no special characters" required="" oninvalid="this.setCustomValidity('Correct keys please')" oninput="this.setCustomValidity('')"><br />
                <button type="submit" name="register" value="Sign Up">SignUp</button>
            </form>
        </div>
    </body>
</html>