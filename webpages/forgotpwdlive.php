<html>
  <head>      
    <meta charset = utf-8>
    <title>Password Reset</title>
    <link rel="stylesheet" href="http://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="../css_html/form.css">
    <link rel="stylesheet" href="../css_html/layout.css">
  </head>
    <body>
        <div class="camagru_header">
            Password Reset
        </div>
        <div class="formbox">
          <form action="../webphp/forgotpwd.php" method="post">
          <label for=password>
              <i class="fas fa-key"></i>
          </label>
          <input class="fieldbox" type="password" id="new_pwd" name="new_pwd" placeholder="New Password" value=""><br />
          <label for=password>
              <i class="fas fa-key"></i>
          </label>
          <input class="fieldbox" type="password" id="new_pwd_confirm" name="new_pwd_confirm" placeholder="Confirm Password" value=""><br />
          <button type="submit" class="formstuff" name="reset_pwd" value="Reset">Reset</button>
          </form>
     </body>
</html>