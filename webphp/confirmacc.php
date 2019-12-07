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
            echo "<script>Cannot get token.</script>";
            exit();
        }
        $result = $stmt->fetch();
        if ($result)
        {
            $stmt = $conn->prepare("UPDATE users SET verified=1 WHERE verif_tokey= :veriftokey");
            $stmt->bindParam(':veriftokey', $tokey);
            if (!$stmt->execute())
            {
                echo "<script>alert('Cannot update token')</script>";
                exit();
            }
            echo "<script class='verified-acc'>Account verified</script>";
            echo "<h4 class='verified-acc1'>Please login:</h4>";
            echo "<form class='verified-acc' action='../webpages/loginlive.php' method='post'><input class='verify-form' type='submit' value='Login page'></input></form>";
            exit();
        }
        else
        {
            echo "<script>alert('Your details were not found.')</script>";
            echo "<form action='../webphp/signup.php' method='post'><input type='submit' value='Create account'></input></form>";
        }
        $conn = NULL;
    }
    else
    {
        echo "<script>alert('No verification token found! Please try again.')</script>";
        echo "<form action='../webphp/signuplive.php' method='post'><input type='submit' value='Sign Up'></input></form>";
        exit();
    }
    ?>
  </body>
</html>
