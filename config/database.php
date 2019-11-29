<?PHP
    $dbname = "camagru";
    $host = "localhost";
    $username = "root";
    $password = "123456";
    $dsn = "mysql:host=$host;dbname=$dbname";

    try 
    {
        $conn = new PDO("mysql:host=$host;", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $sql = 'USE ' . $dbname;
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }
    catch (PDOException $error)
    {
        echo "Connection Failed: ". $error->getMessage();
    }
?>