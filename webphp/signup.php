<?php

if (isset($_POST['register']))
{
	require 'database2.php';

	session_start();
	if (isset($_SESSION['username']))
	{
		echo "<script>alert('Please logout first!!')</script>";
		echo "<script>window.open('../webpages/signuplive.php','_self')</script>";
	}
	if (filter_var($$_POST['email'], FILTER_VALIDATE_EMAIL) === 0)
	{
		echo "<script>alert('Email invalid')</script>";
		echo "<script>window.open('../webpages/signuplive.php','_self')</script>";
		exit();
	}
	if (strlen($_POST['password']) < 6)
	{
		echo "<script>alert('Please make sure your password is 6 characters or longer.')</script>";
		echo "<script>window.open('../webpages/signuplive.php','_self')</script>";
		exit();
	}
	$Lower = preg_match('/[a-z]/', $_POST['password']);
	$Upper = preg_match('/[A-Z]/', $_POST['password']);
	$Digit = preg_match('/[0-9]/', $_POST['password']);
	//$Special = preg_match('/[\W]+/', $pwd);
	if (!$Upper || !$Lower || !$Digit) //|| !$Special)
	{
		echo "<script>alert('Please make sure your password has an array of lowercase letters, uppercase letters, at least one digit and at least one special character.')</script>";
		echo "<script>window.open('../webpages/signuplive.php','_self')</script>";
		exit();
	}
	if ($_POST['password'] !== $_POST['confirmpassword']) 
	{
		echo "<script>alert('Your passwords do not match! Please try again.')</script>";
		echo "<script>window.open('../webpages/signuplive.php?error=passwordsdifference','_self')</script>";
		exit();		
	}

    $username = $_POST['username'];
    // $firstname = $_POST['firstname'];
    // $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = hash("whirlpool", $_POST['password']);
	$confirmpassword = hash("whirlpool", $_POST['confirmpassword']);
	$verified = 0;
	$tokey = bin2hex(random_bytes(16));
	$notified = 1;

    if (empty($username) || empty($email) || empty($password) || empty($confirmpassword))
    {
		echo "<script>alert('Complete all fields!')</script>";
		echo "<script>window.open('../webpages/signuplive.php?error=emptyfields','_self')</script>";
		exit();
	}
	else
	{
		$stmt = $conn->prepare("SELECT * FROM users WHERE email= :email OR username= :user");
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':user', $username);
		if (!$stmt->execute()) 
		{
			echo "<script>alert('SQL ERROR: 1')</script>";
			echo "<script>window.open('../webpages/signuplive.php?error=sqlerror','_self')</script>";
			exit();
		}
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($result['username'] === $username)
		{
			echo "<script>alert('Username taken!')</script>";
			echo "<script>window.open('../webpages/signuplive.php?error=usernametaken','_self')</script>";
			exit();
		}
		else if ($result['email'] === $email)
		{
			echo "<script>alert('Email already in use!')</script>";
			echo "<script>window.open('../webpages/signuplive.php?error=emailtaken','_self')</script>";
			exit();
		}
		else 
		{
			$stmt = $conn->prepare("INSERT INTO `users`(`username`, `passwd`, `email`, `verified`, `verif_tokey`, `notifications`) VALUES (:user, :pass, :email, :verified, :verif_tokey, :notif)");
			$stmt->bindParam(':user', $username);
			$stmt->bindParam(':pass', $password);
			$stmt->bindParam(':email', $email);
			$stmt->bindParam(':verified', $verified);
			$stmt->bindParam(':verif_tokey', $tokey);
			$stmt->bindParam(':notif', $notified);

			if (!$stmt->execute()) 
			{
				echo "<script>alert('SQL ERROR: 1')</script>";
				echo "<script>window.open('../webpages/signuplive.php?error=sqlerror','_self')</script>";
				exit();
			}
			else 
			{
				echo "<script>alert('Success! Please check your email to verify your account')</script>";
				echo "<script>window.open('../webpages/loginlive.php','_self')</script>";
				exit();
			}
		}
	
	}
	$conn = NULL;
}
else 
{
	echo "<script>window.open('../webpages/loginlive.php','_self')</script>";
	exit();
}

?>