<?php

$host = "localhost";
$username = "root";
$password = "123456";

try
{
    $conn = new PDO("mysql:host=$host;dbname=camagru", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $exception)
{
    $msg = $exception->getMessage();
    echo "<script>alert('Connection failed: $msg')</script>";
}

?>