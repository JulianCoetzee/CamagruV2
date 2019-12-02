<?php
function newdb()
{
    $host = "localhost";
    $username = "root";
    $password = "123456";
    $dbname = "camagru";
    try
    {
        $conn = new PDO("mysql:host=$host", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
        $stmt = $conn->exec($sql);
        }
        catch (PDOException $exception)
        {
            $err_msg = $exception->getMessage();
            echo "Could not create database: " . $err_msg;
            exit();
        }
    $conn = NULL;
}
?>