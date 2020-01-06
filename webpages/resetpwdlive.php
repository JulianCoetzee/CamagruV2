<html>
  <head>      
    <meta charset = utf-8>
    <link rel="shortcut icon" type="image/png" href="../cheese/cheese.ico"/>
    <title>Password Reset</title>
    <link rel="stylesheet" href="http://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="../css_html/form.css">
    <link rel="stylesheet" href="../css_html/layout.css">
    <link rel="stylesheet" href="../css_html/footer_conf.css">
  </head>
    <body>
        <div class="camagru_header">
            Password Reset
        </div>
        <div class="formbox">
          <form method="post" action="../webphp/resetpwd.php">
          <label for=password>
              <i class="fas fa-key"></i>
          </label>
          <input class="fieldbox" type="password" id="new_pwd" name="new_pwd" placeholder="New Password" required><br />
          <label for=password>
              <i class="fas fa-key"></i>
          </label>
          <input class="fieldbox" type="password" id="new_pwd_confirm" name="new_pwd_confirm" placeholder="Confirm Password" required><br />
          <input type="hidden" name="tokey" value="<?php echo $_GET['tokey'] ?>">
          <button type="submit" class="formstuff" name="reset_pwd" value="Reset">Reset</button>
          </form>
        </div>
        <div class="footer-2">
		<div class="copyright">Copyright© Camagru - WeThinkCode_ jcoetzee 2019</div>
	</div>
​
  </body>
</html>