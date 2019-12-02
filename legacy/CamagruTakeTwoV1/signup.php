<?php

    require_once "config/setup.php";

if (isset($_POST['submit']))
{    //register
    if (!isset($_POST['username'], $_POST['email'], $_POST['password'], $_POST['confirmpassword']))
    {
        die("Empty Fields, no cheese.");
    }
    $sql = "SELECT `userid` FROM `users` WHERE username=?";
    if ($conn->prepare($sql))
    {
        $stmt->bindParam("s", $_POST['username']);
        $stmt->execute();
        $stmt->store_result;
    }
    // fetch result if result then die("Username taken, stolen cheese.")
    $sql = "SELECT `userid` FROM `users` WHERE email=?";
    if ($conn->prepare($sql))
    {
        $stmt->bindParam("s", $_POST['email']);
        $stmt->execute();
        $stmt->store_result;
    }
    // fetch result if result then die("E-mail taken, cheesed already.")

    //password compare password varify safe vs timing attacks
    $hashpw = hash('whirlpool', $_POST['password']);
    if (!password_verify($_POST['confirmpassword'], $hashpw))
    {
        die("Keys don't match, no cheese");
    }
    else
    {
        $sql = "INSERT INTO users(`username`, `email`, `uhpw`) VALUES(?, ?, ?)";
        if ($conn->prepare($sql))
        {
            $stmt->bindParam("sss", $_POST['username'], $_POST['email'], $hashpw);
            $stmt->execute();
        }
    }
}   