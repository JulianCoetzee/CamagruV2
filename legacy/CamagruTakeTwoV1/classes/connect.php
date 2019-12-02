<?php

function connect()
    {
        try
        {
            require_once "../config/setup.php";
            $conn = new PDO($dsn, $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $error)
        {
            echo "Connection Failed: ". $error->getMessage();
            //die();
        }
    }