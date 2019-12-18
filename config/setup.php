<?php
require "database.php";

newdb();

function user_table()
{
    $host = "localhost";
    $username = "root";
    $password = "123456";
    $dbname = "camagru";
    try
    {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "CREATE TABLE IF NOT EXISTS users(
                username varchar(15) PRIMARY KEY NOT NULL,
                passwd varchar(4096) NOT NULL,
                -- firstname varchar(20) NOT NULL,
                -- surname varchar(20) NOT NULL,
                email varchar(50) NOT NULL,
                verified int(1) DEFAULT '0' NOT NULL,
                verif_tokey VARCHAR(8000) NOT NULL,
                notifications int(1) DEFAULT '1' NOT NULL,
                user_img LONGBLOB)";
        $stmt = $conn->exec($sql);
        }
        catch (PDOException $exception)
        {
            $err_msg = $exception->getMessage();
            echo "Could not create table for users: " . $err_msg;
            exit(); 
        }
    $conn = NULL;    
}

user_table();

function feed_table()
{
    $host = "localhost";
    $username = "root";
    $password = "123456";
    $dbname = "camagru";
    try 
    {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "CREATE TABLE IF NOT EXISTS feed (
                image_id int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
                img LONGTEXT NOT NULL,
                username varchar(15) NOT NULL,
                upload_date datetime NOT NULL,
                likes BIGINT)";
        $stmt = $conn->exec($sql);
    }
    catch (PDOException $exception)
    {
        $err_msg = $exception->getMessage();
        echo "Could not create table for feed: " . $err_msg;
        exit(); 
    }
    $conn = NULL;    
}

feed_table();

function comment_table()
{
    $host = "localhost";
    $username = "root";
    $password = "123456";
    $dbname = "camagru";
    try
    {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "CREATE TABLE IF NOT EXISTS comments (
                comm_id int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
                image_id int(11) NOT NULL,
                comment varchar(200) NOT NULL,
                username varchar(15) NOT NULL,
                comm_date datetime NOT NULL)";
        $stmt = $conn->exec($sql);
    }
    catch (PDOException $exception)
    {
        $err_msg = $exception->getMessage();
        echo "Could not create table for comments: " . $err_msg;
        exit(); 
    }
    $conn = NULL;    
}
comment_table();

require "../webphp/database2.php";
echo "<script>alert('Database created. YAY!')</script>";
echo "<script>window.open('../index.php','_self')</script>";
?>