<html>
  <head>      
    <meta charset = utf-8>
    <link rel="shortcut icon" type="image/png" href="../cheese/cheese.ico"/>
    <title>Password Reset Request</title>
    <link rel="stylesheet" href="http://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="../css_html/form.css">
    <link rel="stylesheet" href="../css_html/layout.css">
    <link rel="stylesheet" href="../css_html/footer_conf.css">
  </head>
    <body>
        <div class="camagru_header">
            Reset Request
        </div>
        <div class="formbox">
            <form method="POST" action="../webphp/resetrequest.php">
                <label for="email">
                <i class="fas fa-envelope"></i>
                </label>
                <input type="text" class="fieldbox" name="email" placeholder="E-mail" id="email" required><br />
          <button type="submit" class="formstuff" name="reset_req" value="reset_req">Request Reset</button><br />
          An email with a link to a reset form will be sent to the specified <u>valid</u> email address.<br />
          </form>
          <div class="footer-2">
		<div class="copyright">Copyright© Camagru - WeThinkCode_ jcoetzee 2019</div>
	</div>
​
  </body>
</html>