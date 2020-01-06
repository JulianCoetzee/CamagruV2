<?php
session_start();
if (isset($_SESSION['username']))
{
	$username = $_SESSION['username'];
	echo "<script>window.open('./webpages/feedlive.php?$username','_self')</script>";
}
else
	echo "<script>window.open('./webphp/login.php','_self')</script>";

?>