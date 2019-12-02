<?php

function pwd_advcheck($pwd)
{
	if (strlen($pwd) < 8)
	{
		echo "<script>alert('Please make sure your password is 8 characters or longer.')</script>";
		echo "<script>window.open('../webphp/forgotpwd.php','_self')</script>";
		exit();
	}
	$Lower = preg_match('/[a-z]/', $pwd);
	$Upper = preg_match('/[A-Z]/', $pwd);
	$Digit = preg_match('/[0-9]/', $pwd);
	$Special = preg_match('/[\W]+/', $pwd);
	if (!$Upper || !$Lower || !$Digit || !$Special)
	{
		echo "<script>alert('Please make sure your password has an array of lowercase letters, uppercase letters, at least one digit and at least one special character.')</script>";
		echo "<script>window.open('../webphp/forgotpwd.php','_self')</script>";
		exit();
	}
}

if (isset($_POST['submit']))
{
	require 'database2.php';
	$username = $_POST['login'];
	$new_password = $_POST['new_password'];
	$repeat = $_POST['repeat'];
	if (empty($new_password) || empty($username) || empty($repeat))
	{
		echo "<script>alert('Please fill in all fields')</script>";
		echo "<script>window.open('../webphp/forgotpwd.php?error=emptyfields','_self')</script>";
		exit();
	}
	pwd_advcheck($new_password);
	if ($new_password !== $repeat) {
		echo "<script>alert('Your passwords do not match! Please try again.')</script>";
		echo "<script>window.open('../webphp/forgotpwd.php?error=passwordsdifference','_self')</script>";
		exit();		
	}
	$stmt = $conn->prepare("SELECT username FROM users WHERE username= :search"); 
	$stmt->bindParam(':search', $username);
	if (!$stmt->execute()) {
		echo "<script>alert('ERROR: 1')</script>";
		echo "<script>window.open('../webphp/forgotpwd.php?error=sql','_self')</script>";
		exit();
	}
	$result = $stmt->fetch();
	if (!$result)
	{
		echo "<script>alert('Username not found! Please make sure you enter your username in correctly.')</script>";
		echo "<script>window.open('../webphp/forgotpwd.php?username=notfound','_self')</script>";
		exit();
	}
	else
	{
		$new = hash("whirlpool", $new_password);
		$stmt = $conn->prepare("UPDATE users SET passwd = :pass WHERE username = :usrn");
		$stmt->bindParam(':pass', $new);
		$stmt->bindParam(':usrn', $username);
		if (!$stmt->execute())
		{
			echo "<script>alert('ERROR: 2')</script>";
			echo "<script>window.open('../webphp/forgotpwd.php?error=sqlerror','_self')</script>";
			exit();
		}
		echo "<script>alert('Saved! Please login with your new details, $username.')</script>";
		session_start();
		$_SESSION['username'] = "";
		session_destroy();
		echo "<script>window.open('../webphp/login.php','_self')</script>";		
	}
	$conn = NULL;
}
else
{
    echo "<script>window.open('../webphp/pass_reset.php','_self')</script>";
    exit();
}
?>