<?php

if (isset($_POST['submit'])) {
	require 'database2.php';

	session_start();
	if (isset($_SESSION['username']))
	{
		echo "<script>alert('Please logout first!!')</script>";
		echo "<script>window.open('../webpages/signuplive.php','_self')</script>";
	}

    $username = $_POST['username'];
    // $firstname = $_POST['firstname'];
    // $surname = $_POST['surname'];
    $email = $_POST['username'];
    $password = hash("whirlpool", $_POST['password']);
	$confirmpassword = hash("whirlpool", $_POST['confirmpassword']);
	$tokey = bin2hex(random_bytes(16));

    if (empty($username) || empty($email) || empty($password) || empty($confirmpassword))
    {
		echo "<script>alert('Complete all fields!')</script>";
		echo "<script>window.open('../webpages/signuplive.php?error=emptyfields','_self')</script>";
		exit();
	}
    else 
    {
		$stmt = $conn->prepare("INSERT INTO `users`(`username`, `passwd`, `email`, `verified`, `verif_tokey`, `notifications`) VALUES (':user', ':pass', ':email' ,':verified', ':veriftokey', ':notif')");
		$stmt->bindParam(':user', $username);
		$stmt->bindParam(':pass', $password);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':verified', 0);
		$stmt->bindParam(':veriftokey', $tokey);
		$stmt->bindParam(':notif', 1);

        if (!$stmt->execute()) 
        {
			echo "<script>alert('SQL ERROR: 1')</script>";
			echo "<script>window.open('../webpages/signuplive.php?error=sqlerror','_self')</script>";
			exit();
		}
		// $result = $stmt->fetch(PDO::FETCH_ASSOC);
	}
	$conn = NULL;
}
else 
{
	echo "<script>window.open('../webpages/loginlive.php','_self')</script>";
	exit();
}

?>