<?php

if (isset($_POST['reset_pwd']))
{
	if (isset($_GET['tokey']))
	{
		require 'database2.php';
		$tokey = $_GET['tokey'];
		$stmt = $conn->prepare("SELECT * FROM users WHERE verif_tokey= :veriftokey");
		$stmt->bindParam(':veriftokey', $tokey);
		if (!$stmt->execute())
		{
			echo "<script>Cannot get token.</script>";
			exit();
		}
		$result = $stmt->fetch();
		if (!$result)			
		{
			echo "<script>alert('Request invalid')</script>";
			echo "<script>window.open('../webpages/resetpwdlive.php?tokey=$tokey','_self')</script>";
			exit();
		}
		else
		{
			function pwd_advcheck($pwd, $tokey)
			{
				if (strlen($pwd) < 6)
				{
					echo "<script>alert('Please make sure your password is 6 characters or longer.')</script>";
					echo "<script>window.open('../webpages/resetpwdlive.php?tokey=$tokey','_self')</script>";
					exit();
				}
				$Lower = preg_match('/[a-z]/', $pwd);
				$Upper = preg_match('/[A-Z]/', $pwd);
				$Digit = preg_match('/[0-9]/', $pwd);
				//$Special = preg_match('/[\W]+/', $pwd);
				if (!$Upper || !$Lower || !$Digit) //|| !$Special)
				{
					echo "<script>alert('Please make sure your password has an array of lowercase letters, uppercase letters and at least one digit.')</script>";
					echo "<script>window.open('../webpages/resetpwdlive.php?tokey=$tokey','_self')</script>";
					exit();
				}
			}
			$newpwd = $_POST['new_password'];
			$confirmpwd = $_POST['new_pwd_confirm'];
			if (empty($newpwd) || empty($confirmpwd))
			{
				echo "<script>alert('Please complete all fields')</script>";
				echo "<script>window.open('../webpages/resetpwdlive.php?tokey=$tokey','_self')</script>";
				exit();
			}
			pwd_advcheck($newpwd, $tokey);
			if ($newpwd !== $confirmpwd) {
				echo "<script>alert('Your passwords do not match! Please try again.')</script>";
				echo "<script>window.open('../webpages/resetpwdlive.php?tokey=$tokey','_self')</script>";
				exit();		
			}
			else
			{
				$username = $result['username'];
				$new = hash("whirlpool", $newpwd);
				$stmt = $conn->prepare("UPDATE users SET passwd= :pass WHERE username= :user");
				$stmt->bindParam(':user', $username);
				$stmt->bindParam(':passwd', $new);
				if (!$stmt->execute())
				{
					echo "<script>alert('ERROR: 1')</script>";
					echo "<script>window.open('../webpages/resetpwdlive.php?tokey=$tokey','_self')</script>";
					exit();
				}
				else
				{
					echo "<script>alert('Saved! Please login with your new details, $username.')</script>";
					session_start();
					$_SESSION['username'] = "";
					session_destroy();
					echo "<script>window.open('../webpages/loginlive.php','_self')</script>";	
				}
			}
		}
	}
	$conn = NULL;
}
else
{
	echo "<script>window.open('../webpages/resetrequestlive.php','_self')</script>";
	exit();
}
?>