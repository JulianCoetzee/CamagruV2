<?php

    require_once "config/setup.php";
    session_start() or die ("Session Error");
    
    // users class (require)
    // $check_existinguser = new users($username, $password, $email, $confirmpassword, $token);
    // $check_existinguser->fetchuser();

?>

<html>
    <head>
        <meta charset = utf-8>
        <title>Camagru SignUp</title>
        <link rel="stylesheet" href="http://use.fontawesome.com/releases/v5.7.1/css/all.css">
    </head>
    <body>
        <div class="login">
            <h1>Sign Up</h1>
            <form action="" method="POST">
                <label for="username">
                    <i class="fas fa-cheese">Username</i>
                </label>
                <input type="text" name="username" placeholder="Username" id="username" pattern="[a-zA-Z0-9]{6-30}" title="Your username should contain at least 6 characters including 1 UPPERCASE and 1 number and no special characters" required="" oninvalid="this.setCustomValidity('Correct cheese please')" oninput="this.setCustomValidity('')"><br />
                <label for="email">
                <i class="fas fa-envelope-square">Email</i>
                </label>
                <input type="text" name="email" placeholder="E-mail" id="email" required><br />
                <label for="password">
                    <i class="fas fa-key">Password</i>
                </label>
                <input type="password" name="password" placeholder="Password" id="password" pattern="[a-zA-Z0-9]{6-30}" title="Your password must contain at least 6 characters including 1 UPPERCASE and 1 number and no special characters" required="" oninvalid="this.setCustomValidity('Correct keys please')" oninput="this.setCustomValidity('')"><br />
                <label for="confirmpassword">
                    <i class="fas fa-key">Confirm</i>
                </label>
                <input type="password" name="confirmpassword" placeholder=" Confirm Password" id="confirmpassword" pattern="[a-zA-Z0-9]{6-30}" title="Your password must contain at least 6 characters including 1 UPPERCASE and 1 number and no special characters" required="" oninvalid="this.setCustomValidity('Correct keys please')" oninput="this.setCustomValidity('')"><br />
                <button type="submit" name="register" value="Sign Up">Register</button>
            </form>
        </div>
    </body>
</html>

<?php

    require_once "classes/users.php";

    $new = new users($_POST['username'], $_POST['email'], $_POST['password'], $_POST['confirmpassword']);
    if ($new->new_user())
        return ($this->err_msg);

?>