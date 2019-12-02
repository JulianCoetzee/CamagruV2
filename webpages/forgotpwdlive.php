<html>
  <head>
    <meta charset="utf-8">
    <title>Password Reset</title>
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="">
  </head>
  <body>
    <h2>Reset Password</h2>
    <form action="../webphp/forgotpwd.php" method="post">
    <label for=password>
        <i class="fas fa-key"></i>
    </label>
    New Password: <br /><input type="password" id="new_pwd" name="new_pwd" placeholder="New Password" value=""><br />
    <label for=password>
        <i class="fas fa-key"></i>
    </label>
    Confirm New Password: <br /><input type="password" id="new_pwd_confirm" name="new_pwd_confirm" placeholder="Confirm Password" value=""><br />
    <button type="submit" name="reset_pwd" value="Reset">Reset</button>
    </form>
     </body>
</html>