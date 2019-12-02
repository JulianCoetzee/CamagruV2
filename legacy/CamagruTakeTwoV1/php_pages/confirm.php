<?php
  $pages  = 'MIME-Version: 1.0'."\n";
  $pages .= 'Content-type: text/html; charset=iso-8859-1'."\n";
  $pages .= "From: camagru-noreply@student.wtc.co.za\n";
  $mail = "<html><body>";
  $mail.= "<p>HI!" . $this->username . ",</p>";
  $mail.= "";
  $mail.= "<a href=http://" . $url .">Click Me!</a></p>";
  $mail.= "<p>Camagru Awaits!!</p>";
  $mail.= "<p>Camagru</p>";
  $mail.= "</body></html>";
  if (mail($this->email, "Confirm your Camagru account", $mail, $pages))
    $this->err_msg = "An email with your OTP link has been sent to you!";
  else
    return $this->err_msg = "Email could not be sent.";
  ?>