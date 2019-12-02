<html>
  <head>
    <title>Verify Account</title>
  </head>
  <body>
  <?php
    if (isset($_GET['tokey']))
    {
        require 'database2.php';
        $tokey = $_GET['tokey'];
        $stmt = $conn->prepare("SELECT * FROM users WHERE verif_tokey= :veriftokey");
        $stmt->bindParam(':veriftokey', $tokey);
        if (!$stmt->execute())
        {
            echo "<h2>Cannot get token.</h2>";
            exit();
        }
        $result = $stmt->fetch();
        if ($result)
        {
            $stmt = $conn->prepare("UPDATE users SET verified=1 WHERE verif_tokey= :veriftokey");
            $stmt->bindParam(':veriftokey', $tokey);
            if (!$stmt->execute())
            {
                echo "<h2>Cannot update token</h2>";
                exit();
            }
            echo "<h2 class='verified-acc'>Account verified</h2>";
            echo "<h4 class='verified-acc1'>Please login:</h4>";
            echo "<form class='verified-acc' action='../pages/login.php' method='post'><input class='verify-form' type='submit' value='Login page'></input></form>";
            exit();
        }
        else
        {
            echo "<h2>Your details were not found.<h2>";
            echo "<form action='../pages/create.php' method='post'><input type='submit' value='Create account'></input></form>";
        }
        $conn = NULL;
    }
    else
    {
        echo "<h2>No verification token found! Please try again.<h2>";
        echo "<form action='../pages/create.php' method='post'><input type='submit' value='Create account'></input></form>";
        exit();
    }
    ?>
  </body>
</html>
