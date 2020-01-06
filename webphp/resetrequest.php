
<?php

function email_send($email, $tokey)
{
    $subject = "Camagru - Password Reset";
	$message = "<a href='http://localhost:8080/CamagruTakeTwo/webpages/resetpwdlive.php?tokey=$tokey'>Click this link to reset your Camagru password!</a><br /><br />";
	//$message .= "Welcome aboard.<br /><br />Camagru_Team";
    $headers = "From: no-reply_camagru@gmail.com \r\n";
    $headers .= "MINE-Version: 1.0"."\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8"."\r\n";
    $res = mail($email, $subject, $message, $headers);
	if ($res)
	{
        echo "<script>alert('Success! Please check your email for a password reset link.')</script>";
        echo "<script>window.open('../webphp/logout.php','_self')</script>";
    }
	else
	{
        echo "<script>alert('Failed to send email!')</script>";
        echo "<script>window.open('../webpages/resetrequestlive.php','_self')</script>";
    }
}

if(!isset($_SESSION['username']))
{
  session_start();
  if (!isset($_SESSION['username']))
    echo "<script>window.open('../webphp/login.php','_self')</script>";
}

if (isset($_POST['change_pwd']))
{
    require 'database2.php';
    $password = hash("whirlpool", $_POST['password3']);
	$username = $_SESSION['username'];

	if (empty($password) || empty($username))
	{
		echo "<script>alert('Complete all fields!')</script>";
		echo "<script>window.open('../webpages/profilelive.php?error=emptyoldpwd','_self')</script>";
		exit();
	}
	else
	{
		$stmt = $conn->prepare("SELECT * FROM users WHERE passwd= :pass AND username= :user");
		$stmt->bindParam(':pass', $password);
		$stmt->bindParam(':user', $username);
		if (!$stmt->execute()) 
		{
			echo "<script>alert('SQL ERROR: 1')</script>";
			echo "<script>window.open('../webpages/profilelive.php?error=sqlerror','_self')</script>";
			exit();
		}
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$result)
		{
			echo "<script>alert('Password incorrect.')</script>";
			echo "<script>window.open('../webpages/profilelive.php?pasword=incorrect','_self')</script>";
        }
        else 
        {
            $tokey = bin2hex(random_bytes(16));
            $stmt = $conn->prepare("UPDATE users SET verif_tokey= :veriftokey WHERE username= :user");
            $stmt->bindParam(':veriftokey', $tokey);
            $stmt->bindParam(':user', $username);
            if (!$stmt->execute())
            {
                echo "<script>alert('Cannot update password reset token')</script>";
                echo "<script>window.open('../webpages/profilelive.php','_self')</script>";
                exit();
            }
            else 
			{
                echo "<script>window.open('../webpages/resetpwdlive.php?tokey=$tokey','_self')</script>";
                exit();
			}      
        }
    }
    $conn = NULL;
}

if (isset($_POST['reset_req']))
{
	require 'database2.php';
	$email = $_POST['email'];
    if (empty($email))
    {
		echo "<script>alert('Please complete all fields')</script>";
		echo "<script>window.open('../webpages/resetrequestlive.php?error=emptyfields','_self')</script>";
		exit();
    }
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === 0)
	{
		echo "<script>alert('Email invalid')</script>";
		echo "<script>window.open('../webpages/resetrequestlive.php','_self')</script>";
        exit();
    }
    else
	{
		$stmt = $conn->prepare("SELECT * FROM users WHERE email= :email");
		$stmt->bindParam(':email', $email);
		if (!$stmt->execute()) 
		{
			echo "<script>alert('SQL ERROR: 1')</script>";
			echo "<script>window.open('../webpages/resetrequestlive.php?error=sqlerror','_self')</script>";
			exit();
		}
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$result)
        {
            echo "<script>alert('Email not found')</script>";
		    echo "<script>window.open('../webpages/resetrequestlive.php','_self')</script>";
            exit();
        }
        else if ($result['verified'] === 0)
        {
            echo "<script>alert('Account not verified. Please verify your account.')</script>";
		    echo "<script>window.open('../webpages/resetrequestlive.php','_self')</script>";
            exit();
        }
        else if ($result['email'] === $email)
        {
            $tokey = bin2hex(random_bytes(16));
            $stmt = $conn->prepare("UPDATE users SET verif_tokey= :veriftokey WHERE email= :email");
            $stmt->bindParam(':veriftokey', $tokey);
            $stmt->bindParam(':email', $email);
            if (!$stmt->execute())
            {
                echo "<script>alert('Cannot update token')</script>";
                echo "<script>window.open('../webpages/resetrequestlive.php','_self')</script>";
                exit();
            }
            else 
			{
				email_send($email, $tokey);
			}
        }
    }

}
else
{
    echo "<script>window.open('../webpages/resetrequestlive.php','_self')</script>";
    exit();
}