<?php
	if(!isset($_SESSION['username']))
    session_start();
?>

<html>
  <head>      
    <meta charset = utf-8>
    <title>Profile | Options</title>
    <link rel="stylesheet" href="http://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="../css_html/form.css">
    <link rel="stylesheet" href="../css_html/layout.css">
  </head>
    <body>
    <div class="camagru_header">
        <?php
        if(isset($_SESSION['username']))
          echo ($_SESSION['username']."'s Profile Options<br />");
        ?>
    </div>
    <div class="profile-links">
    <?php
        if(isset($_SESSION['username']))
        {
            echo("<a id='logout' href='../webphp/logout.php'>Logout</a>"); 
        }
        else
            {
            echo("<div class='create'>
                    <a id='link' href='signuplive.php'>Sign Up</a>
                </div>
                <div class='create'>
                    <a id='link' href='loginlive.php'>Login</a>
                </div>");
            }
        ?>
    </div>
    <div class="option_block_1">
      <h3>Change Username</h3>
            <div class="formboxprof">
            <form action="../webphp/useroptions.php" method="POST">
            <label for="newusername">
                    <i class="fas fa-cheese"></i>
                </label>
                <input type="text" class="fieldbox" name="newusername" placeholder="New Username" id="newusername" pattern="[a-zA-Z0-9]{6-30}" title="Your username should contain at least 6 characters including 1 UPPERCASE and 1 number and no special characters" oninvalid="this.setCustomValidity('Correct cheese please')" oninput="this.setCustomValidity('')"><br />
                <label for="password1">
                    <i class="fas fa-key"></i>
                </label>
                <input type="password" class="fieldbox" name="password1" placeholder="Current Password" id="password1" pattern="[a-zA-Z0-9]{6-30}" title="Your password must contain at least 6 characters including 1 UPPERCASE and 1 number and no special characters" oninvalid="this.setCustomValidity('Correct keys please')" oninput="this.setCustomValidity('')"><br />
                <button type="submit" class="formstuff" name="change_username" value="change_username">Change</button>
            </form>
            </div>
    </div>
    <div class="option_block_2">
      <h3>Change Email</h3>
              <div class="formboxprof">
              <form action="../webphp/useroptions.php" method="POST">
              <label for="email">
                <i class="fas fa-envelope"></i>
                </label>
                <input type="text" class="fieldbox" name="email" placeholder="New E-mail" id="email"><br />
                <label for="password2">
                    <i class="fas fa-key"></i>
                </label>
                <input type="password" class="fieldbox" name="password2" placeholder="Current Password" id="password2" pattern="[a-zA-Z0-9]{6-30}" title="Your password must contain at least 6 characters including 1 UPPERCASE and 1 number and no special characters" oninvalid="this.setCustomValidity('Correct keys please')" oninput="this.setCustomValidity('')"><br />
                <button type="submit" class="formstuff" name="change_email" value="change_email">Change</button>
              </form>
              </div>
    </div>
    <div class="option_block_3" >
      <h3>Change Password</h3>
              <div class="formboxprof">
              <form action="../webphp/resetrequest.php" method="POST">
              <label for="password3">
                    <i class="fas fa-key"></i>
                </label>
                <input type="password" class="fieldbox" name="password3" placeholder="Current Password" id="password3" pattern="[a-zA-Z0-9]{6-30}" title="Your password must contain at least 6 characters including 1 UPPERCASE and 1 number and no special characters" oninvalid="this.setCustomValidity('Correct keys please')" oninput="this.setCustomValidity('')"><br />
                <button type="submit" class="formstuff" name="change_pwd" value="change_pwd">Change</button>
              </form>
              </div>
    </div>
    <div class="option_block_4" >
      <h3>Delete Account  </h3>
              <div class="formboxprof">
              <form action="../webphp/useroptions.php" method="POST">
              <label for="password4">
                    <i class="fas fa-key"></i>
                </label>
                <input type="password" class="fieldbox" name="password4" placeholder="Current Password" id="password4" pattern="[a-zA-Z0-9]{6-30}" title="Your password must contain at least 6 characters including 1 UPPERCASE and 1 number and no special characters" oninvalid="this.setCustomValidity('Correct keys please')" oninput="this.setCustomValidity('')"><br />
                <label for="confirmpassword4">
                    <i class="fas fa-key"></i>
                </label>
                <input type="password" class="fieldbox" name="confirmpassword4" placeholder="Confirm Password" id="confirmpassword4" pattern="[a-zA-Z0-9]{6-30}" title="Your password must contain at least 6 characters including 1 UPPERCASE and 1 number and no special characters" oninvalid="this.setCustomValidity('Correct keys please')" oninput="this.setCustomValidity('')"><br />
                <button type="submit" class="formstuff" name="delete_user" value="delete_user">Delete Account</button>
              </form>
              </div>
    </div>
    <!-- <div class="footer">
		<p>Julian Coetzee</p>
		<div class="copyright">Copyright© Camagru - WeThinkCode_ jcoetzee 2019</div>
	</div> -->

     </body>
</html>