<?php
// function email_send($email, $tokey, $username)
// {
//     $subject = "Camagru - Account Activation";
// 	$message = "<a href='http://localhost:8080/CamagruTakeTwo/webphp/confirmacc.php?tokey=$tokey'>Click this link to verify your Camagru account!</a><br /><br />";
// 	$message .= "Welcome aboard.<br /><br />Camagru_Team";
//     $headers = "From: no-reply_camagru@gmail.com \r\n";
//     $headers .= "MINE-Version: 1.0"."\r\n";
//     $headers .= "Content-type:text/html;charset=UTF-8"."\r\n";
//     $res = mail($email, $subject, $message, $headers);
// 	if ($res)
// 	{
//         echo "<script>alert('Success! Please check your email to verify your account.')</script>";
//         echo "<script>window.open('../webpages/loginlive.php','_self')</script>";
//     }
// 	else
// 	{
// 		require_once 'database2.php';

// 		$stmt = $conn->prepare("DELETE * FROM users WHERE username= :user");
// 		$stmt->bindParam(':user', $username);
// 		if (!$stmt->execute()) 
// 		{
// 			echo "<script>alert('SQL ERROR: 1')</script>";
// 			echo "<script>window.open('../webpages/signuplive.php?error=sqlerror','_self')</script>";
// 			exit();
// 		}
//         echo "<script>alert('Failed to send email!')</script>";
//         echo "<script>window.open('../webpages/signuplive.php','_self')</script>";
//     }
// }
if(!isset($_SESSION['username']))
	session_start();

if (isset($_POST['change_username']))
{
	require 'database2.php';

	// if(!isset($_SESSION['username']))
	//  	session_start();
	if (!isset($_SESSION['username']))
	{
		echo "<script>alert('Please login first.')</script>";
		echo "<script>window.open('../webpages/loginlive.php','_self')</script>";
	}
	if (strlen($_POST['password1']) < 6)
	{
		echo "<script>alert('Please make sure your password is 6 characters or longer.')</script>";
		echo "<script>window.open('../webpages/profilelive.php','_self')</script>";
		exit();
	}
	$Lower = preg_match('/[a-z]/', $_POST['password1']);
	$Upper = preg_match('/[A-Z]/', $_POST['password1']);
	$Digit = preg_match('/[0-9]/', $_POST['password1']);
	//$Special = preg_match('/[\W]+/', $pwd);
	if (!$Upper || !$Lower || !$Digit) //|| !$Special)
	{
		echo "<script>alert('Please make sure your password has an array of lowercase letters, uppercase letters and at least one digit.')</script>";
		echo "<script>window.open('../webpages/profilelive.php','_self')</script>";
		exit();
	}

    $newusername = $_POST['newusername'];
    $password = hash("whirlpool", $_POST['password1']);
	//$notified = 1;

    if (empty($newusername) || empty($password))
    {
		echo "<script>alert('Complete all fields.')</script>";
		echo "<script>window.open('../webpages/profilelive.php?error=emptyfields','_self')</script>";
		exit();
	}
	else
	{
        $oldusername = $_SESSION['username'];
		$stmt = $conn->prepare("SELECT * FROM users WHERE username= :user");
		$stmt->bindParam(':user', $newusername);
		if (!$stmt->execute()) 
		{
			echo "<script>alert('SQL ERROR: 1')</script>";
			echo "<script>window.open('../webpages/profilelive.php?error=sqlerror','_self')</script>";
			exit();
		}
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($result['username'] === $newusername)
		{
			echo "<script>alert('Username taken!')</script>";
			echo "<script>window.open('../webpages/profilelive.php?error=usernametaken','_self')</script>";
			exit();
		}
		else if (!$result)
		{
			$stmt = $conn->prepare("UPDATE users SET username= :newuser WHERE username= :user AND passwd= :pass");
            $stmt->bindParam(':newuser', $newusername);
            $stmt->bindParam(':user', $oldusername);
            $stmt->bindParam(':pass', $password);
            if (!$stmt->execute())
            {
                echo "<script>alert('SQL ERROR: 1')</script>";
			    echo "<script>window.open('../webpages/profilelive.php?error=sqlerror','_self')</script>";
                exit();
            }
            else
            {
                echo "<script>alert('Success! Please login with new username.')</script>";
			    echo "<script>window.open('../webpages/loginlive.php?error=sqlerror','_self')</script>";
                exit();
            }
        }
    } 
    $conn = NULL;
}       

// if (isset($_POST['change_email']))
// {
// 	require 'database2.php';

// 	// if(!isset($_SESSION['username']))
// 	//  	session_start();
// 	if (!isset($_SESSION['username']))
// 	{
// 		echo "<script>alert('Please login first.')</script>";
// 		echo "<script>window.open('../webpages/loginlive.php','_self')</script>";
// 	}
//     if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === 0)
// 	{
// 		echo "<script>alert('Email invalid')</script>";
// 		echo "<script>window.open('../webpages/signuplive.php','_self')</script>";
// 		exit();
// 	}
// 	if (strlen($_POST['password']) < 6)
// 	{
// 		echo "<script>alert('Please make sure your password is 6 characters or longer.')</script>";
// 		echo "<script>window.open('../webpages/signuplive.php','_self')</script>";
// 		exit();
// 	}
// 	$Lower = preg_match('/[a-z]/', $_POST['password']);
// 	$Upper = preg_match('/[A-Z]/', $_POST['password']);
// 	$Digit = preg_match('/[0-9]/', $_POST['password']);
// 	//$Special = preg_match('/[\W]+/', $pwd);
// 	if (!$Upper || !$Lower || !$Digit) //|| !$Special)
// 	{
// 		echo "<script>alert('Please make sure your password has an array of lowercase letters, uppercase letters and at least one digit.')</script>";
// 		echo "<script>window.open('../webpages/signuplive.php','_self')</script>";
// 		exit();
// 	}
// 	if ($_POST['password'] !== $_POST['confirmpassword']) 
// 	{
// 		echo "<script>alert('Your passwords do not match! Please try again.')</script>";
// 		echo "<script>window.open('../webpages/signuplive.php?error=passwordsdifference','_self')</script>";
// 		exit();		
// 	}

//     $username = $_POST['username'];
//     // $firstname = $_POST['firstname'];
//     // $surname = $_POST['surname'];
//     $email = $_POST['email'];
//     $password = hash("whirlpool", $_POST['password']);
// 	$confirmpassword = hash("whirlpool", $_POST['confirmpassword']);
// 	$verified = 0;
// 	$tokey = bin2hex(random_bytes(16));
// 	//$notified = 1;

//     if (empty($username) || empty($email) || empty($password) || empty($confirmpassword))
//     {
// 		echo "<script>alert('Complete all fields!')</script>";
// 		echo "<script>window.open('../webpages/signuplive.php?error=emptyfields','_self')</script>";
// 		exit();
// 	}
// 	else
// 	{
// 		$stmt = $conn->prepare("SELECT * FROM users WHERE email= :email OR username= :user");
// 		$stmt->bindParam(':email', $email);
// 		$stmt->bindParam(':user', $username);
// 		if (!$stmt->execute()) 
// 		{
// 			echo "<script>alert('SQL ERROR: 1')</script>";
// 			echo "<script>window.open('../webpages/signuplive.php?error=sqlerror','_self')</script>";
// 			exit();
// 		}
// 		$result = $stmt->fetch(PDO::FETCH_ASSOC);
// 		if ($result['username'] === $username)
// 		{
// 			echo "<script>alert('Username taken!')</script>";
// 			echo "<script>window.open('../webpages/signuplive.php?error=usernametaken','_self')</script>";
// 			exit();
// 		}
// 		else if ($result['email'] === $email)
// 		{
// 			echo "<script>alert('Email already in use!')</script>";
// 			echo "<script>window.open('../webpages/signuplive.php?error=emailtaken','_self')</script>";
// 			exit();
//         }
        

if (isset($_POST['delete_user']))
{
	require 'database2.php';

	// if(!isset($_SESSION['username']))
	//  	session_start();
	if (!isset($_SESSION['username']))
	{
		echo "<script>alert('Please login first.')</script>";
		echo "<script>window.open('../webpages/loginlive.php','_self')</script>";
	}
	// if (strlen($_POST['password4']) < 6)
	// {
	// 	echo "<script>alert('Please make sure your password is 6 characters or longer.')</script>";
	// 	echo "<script>window.open('../webpages/profilelive.php','_self')</script>";
	// 	exit();
	// }
	// $Lower = preg_match('/[a-z]/', $_POST['password4']);
	// $Upper = preg_match('/[A-Z]/', $_POST['password4']);
	// $Digit = preg_match('/[0-9]/', $_POST['password4']);
	// //$Special = preg_match('/[\W]+/', $pwd);
	// if (!$Upper || !$Lower || !$Digit) //|| !$Special)
	// {
	// 	echo "<script>alert('Please make sure your password has an array of lowercase letters, uppercase letters and at least one digit.')</script>";
	// 	echo "<script>window.open('../webpages/profilelive.php','_self')</script>";
	// 	exit();
	// }
	if ($_POST['password4'] !== $_POST['confirmpassword4']) 
	{
		echo "<script>alert('Your passwords do not match.')</script>";
		echo "<script>window.open('../webpages/profilelive.php?error=passwordsdifference','_self')</script>";
		exit();		
	}

    $username = $_SESSION['username'];
    $password = hash("whirlpool", $_POST['password4']);
	$confirmpassword = hash("whirlpool", $_POST['confirmpassword4']);
	//$notified = 1;

    if (empty($password) || empty($confirmpassword))
    {
		echo "<script>alert('Complete all fields!')</script>";
		echo "<script>window.open('../webpages/profilelive.php?error=emptyfields','_self')</script>";
		exit();
	}
	else
	{
		$stmt = $conn->prepare("DELETE FROM users WHERE passwd= :pass AND username= :user");
		$stmt->bindParam(':pass', $password);
		$stmt->bindParam(':user', $username);
		if (!$stmt->execute()) 
		{
			echo "<script>alert('SQL ERROR: 1')</script>";
			echo "<script>window.open('../webpages/profilelive.php?error=sqlerror','_self')</script>";
            exit();
        }
        else
        {
            echo "<script>alert('Account Successfully Deleted')</script>";
			echo "<script>window.open('../webpages/signuplive.php','_self')</script>";
            exit();
        }
    }
    $conn = NULL;
}
else 
{
	echo "<script>window.open('../webpages/profilelive.php','_self')</script>";
	exit();
}