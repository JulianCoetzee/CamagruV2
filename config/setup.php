<?php
    require_once "database.php";

    try
    {
        $conn = new PDO($dsn, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "CREATE TABLE IF NOT EXISTS `users` (
            `userid` INT AUTO_INCREMENT PRIMARY KEY,
            `username` VARCHAR(255) NOT NULL,
            `email` VARCHAR(255) NOT NULL,
            `uhpw` VARCHAR(255) NOT NULL,
            `salt` VARCHAR(255) NOT NULL,
            `verified` BOOLEAN DEFAULT 0 NOT NULL,
            `createdate` DATETIME NOT NULL)";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $sql = "CREATE TABLE IF NOT EXISTS `images` (
            `imgid` INT AUTO_INCREMENT PRIMARY KEY,
            `userid` VARCHAR(255) NOT NULL,
            `image` VARCHAR(255) NOT NULL,
            `createdate` DATETIME NOT NULL)";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $sql = "CREATE TABLE IF NOT EXISTS `likes` (
            `likeid` INT AUTO_INCREMENT PRIMARY KEY,
            `userid` VARCHAR(255) NOT NULL,
            `imgid` VARCHAR(255) NOT NULL,
            `likedate` DATETIME NOT NULL)";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $sql = "CREATE TABLE IF NOT EXISTS `comments` (
            `comid` INT AUTO_INCREMENT PRIMARY KEY,
            `userid` VARCHAR(255) NOT NULL,
            `imgid` VARCHAR(255) NOT NULL,
            `comcon` LONGBLOB NOT NULL,
            `comdate` DATETIME NOT NULL)";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }
    
    catch (PDOException $error)
    {
        echo "Connection Failed: ". $error->getMessage();
    }