<?php

function logout()
{
    session_start();
    $_SESSION['username'] = "";
    session_destroy();
    echo "<script>window.open('../webphp/login.php','_self')</script>";
}

session_start();
if (isset($_SESSION['username']))
{
        logout();
}
else
{
    echo "<script>window.open('../webphp/login.php','_self')</script>";
    exit();
}
?>