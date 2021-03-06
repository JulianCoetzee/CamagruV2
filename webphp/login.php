<?php

if (isset($_POST['login'])) {
	require 'database2.php';

	if (!isset($_SESSION['username']))
		session_start();
	//if (isset($_SESSION['username']))
	//{
	//	echo "<script>alert('Please logout first!!')</script>";
	//	echo "<script>window.open('../webpages/loginlive.php','_self')</script>";
	//}

	$password = hash("whirlpool", $_POST['password']);
	$username = $_POST['username'];

	if (empty($password) || empty($username))
	{
		echo "<script>alert('Complete all fields!')</script>";
		echo "<script>window.open('../webpages/loginlive.php?error=emptyfields','_self')</script>";
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
			echo "<script>window.open('../webpages/loginlive.php?error=sqlerror','_self')</script>";
			exit();
		}
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($result && ($result['verified']))
		{
			session_start();
			$_SESSION['username'] = $username;
			echo "<script>alert('Welcome $username!')</script>";
			echo "<script>window.open('../webpages/feedlive.php?home=$username','_self')</script>";
			exit();
		}
		else
		{
			echo "<script>alert('Details entered have not been found! Consider creating an account.')</script>";
			echo "<script>window.open('../webpages/loginlive.php?login=failure','_self')</script>";
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