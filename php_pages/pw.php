<html>
  <head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>Password Reset</title>
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="">
  </head>
  <body>
    <?php include 'webhead.php'; ?>
    <h2>Reset Password</h2>
    <form class="" action="#" method="post">
      New Password: <br /><input type="password" name="new_pw" placeholder="New Password" value=""><br />
      Confirm New Password: <br /><input type="password" name="new_pw_confirm" placeholder="Confirm Password" value=""><br />
       <input id="forgot_button" class="button" type="submit" name="submit" value="OK">
    </form>
    <?php

    require '../classes/users.php';
    
    if (htmlentities($_GET['q']) != "" && !empty($_POST['new_pw']) && !empty($_POST['new_pw_confirm']) && $_POST['submit'] == "OK")
    {
      $token = htmlentities($_GET['q']);
      $new_pw = $_POST['new_pw'];
      $conn = new Users("", $_POST['new_pw'], $_POST['new_pw_confirm'], "", $token);
      $conn->resetPassword();
      if ($conn->message)
        echo '<p style="color:red;">' . $conn->message . '</p>';
    }
     ?>
  </body>
</html>