<?php

if (isset($_POST['submit']))
{
    if (empty($_POST['email']))
    {
        echo "<script>alert('Please fill in your email.')</script>";
        echo "<script>window.open('../webphp/resetpwd.php','_self')</script>";        
    }
    require 'database2.php';
    $sender = $_POST['email'];
    $stmt = $conn->prepare("SELECT email FROM users WHERE email= :email");
    $stmt->bindParam(':email', $sender);
    if (!$stmt->execute())
    {
		echo "<script>alert('ERROR: 1')</script>";
		echo "<script>window.open('../webphp/resetpwd.php?error=sql','_self')</script>";
		exit();
	}
	$result = $stmt->fetch();
    if (!$result)
    {
		echo "<script>alert('Email not found.')</script>";
		echo "<script>window.open('../webphp/resetpwd.php?email=notfound','_self')</script>";
		exit();
    }
    else
    {
        $subject = "Camagru - Password Reset";
        $headers = "From: camagru@futoo.com \r\n";
        $headers .= "MINE-Version: 1.0"."\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8"."\r\n";
        $message = "<a href='http://localhost:8080/Camagru/webphp/forgotpwd.php'>Use this link to reset your password</a>";
        $res = mail($sender, $subject, $message, $headers);
        if ($res == TRUE)
        {
            echo "<script>alert('Email with password reset link sent')</script>";
            echo "<script>window.open('../webphp/login.php','_self')</script>";
        }
        else
        {
            echo "<script>alert('Failed to send email!')</script>";
            echo "<script>window.open('../webphp/resetpwd.php','_self')</script>";
        }
    }
    $conn = NULL;
}
else
    echo "<script>window.open('../webphp/resetpwd.php?','_self')</script>";
?>