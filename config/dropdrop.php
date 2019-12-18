<?php
    $host = "localhost";
    $username = "root";
    $password = "123456";
    $dbname = "camagru";
    try
    {
        $conn = new PDO("mysql:host=$host", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DROP DATABASE $dbname";
        $stmt = $conn->exec($sql);
    }
    catch (PDOException $exception)
    {
        $err_msg = $exception->getMessage();
        echo "Could not delete database: " . $err_msg;
        exit();
    }
    $conn = NULL;
echo "<script>alert('Database DELETED. YAY!')</script>";
echo "<script>window.open('setup.php','_self')</script>";
?>