<?php

    require_once "config/setup.php";

    if (!isset($_POST['username'], $_POST['password']))
    {
        die("Cheese or keys, please.");
    }
    $sql = "SELECT userid, uhpw FROM users WHERE username=?";
    if ($conn->prepare($sql))
    {
        $stmt->bindParam("s", $_POST['username']);
        $stmt->execute();
        $stmt->store_result;
    }