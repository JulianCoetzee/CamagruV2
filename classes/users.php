<?php

class users
{
    private $user;
    private $conn;
    private $email;
    private $password;
    private $confirmpassword;
    private $token;
    private $err_msg;

    public function __construct($user, $password, $email, $confirmpassword)//, $token)
    {
        try
        {
            require_once "config/setup.php";
            $this->conn = new PDO($dsn, $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->username = $user;
            $this->email = $email;
            $this->uhpw = $password;
            $this->confirmpassword = $confirmpassword;
            //$this->token = $token;
        }
        catch (PDOException $error)
        {
            echo "Connection Failed: ". $error->getMessage();
            //die();
        }
    }
    private function fetch_user()
    {
        try
        {
            $sql = "SELECT * FROM `users` WHERE `username`=?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($this->user));
            $user_array = $stmt->fetch(PDO::FETCH_ASSOC);
            return ($user_array);
        }
        catch (PDOException $error)
        {
            echo "Connection Failed: ". $error->getMessage();
            //die();
        }
    }
    private function password_check()
    {
        try
        {
            if (strlen($this->password) > 30)
                return $this->err_msg = "Password cannot exceed 30 characters";
            if ($this->password != $this->confirmpassword)
                return $this->err_msg= "Passwords do not match";
        }
        catch (PDOException $error)
        {
            echo "Connection Failed: ". $error->getMessage();
            //die();
        }
    }
    public function user_check()
    {
        try 
        {
            $user = $this->fetch_user();
            if (!$user)
                return $this->err_msg = "User account cannot be found";
            if ($user['verified'] == 0)
                return $this->err_msg = "Account unverified";
            if ($user['uhpw'] != hash('whirlpool', $this->password))
                return $this->err_msg = "Incorrect password. Wrong keys.";
        }
        catch (PDOException $error) 
        {
            echo "Connection Failed: ". $error->getMessage();
            //die();
        }
    }
    private function new_user()
    {
        try
        {
            if (strlen($this->user) > 30)
                return $this->err_msg = "Username cannot exceed 30 characters";
            $newuser = fetch_user();
            if ($newuser)
                return $this->err_msg = "Username already taken";
            self::password_check();
            if ($this->err_msg != NULL)
                return ;
            if (filter_var($this->email, FILTER_VALIDATE_EMAIL) === false)
                return $this->err_msg = "Email invalid";
        }
        catch (PDOException $error)
            {
                echo "Connection Failed: ". $error->getMessage();
                //die();
            }
    }
    public function send_confirm()
    {
        self::user_check();
        if ($this->err_msg)
            return ;
        $token = bin2hex(random_bytes(16));
        $url = "localhost:8080/CamagruTakeTwo/phppages/dashboard?q=". $token;
        date_default_timezone_set();
            $createdate = date("Ymd H: m: s");
        $tokenexpires = date("Ymd H: m: s", strtotime($createdate .'+ 2 days'));
        try
        {
            $sql = "INSERT INTO `users`(`username`, `uhpw`, `email`, `token`, `tokenexpires`, `createdate`) VALUES(?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array($this->username, hash('whirlpool', $this->uhpw), $this->email, $token, $tokenspires, $createdate));
            $sql2 = "DELETE FROM `users` WHERE `tokenexpires`< NOW() AND `verified` = 0";
            $stmt = $this->conn->prepare($sql2);
            $stmt->execute();
            require_once "../webapp/confrim_mail.php";
        }
        catch (PDOException $error)
        {
            echo "Connection Failed: ". $error->getMessage();
            //die();
        }
    }
    public  function  resetPassword()
    {
        try
        {
          $sql = $this->conn->prepare("SELECT * FROM `users` WHERE `token`=?");
          $stmt = $req->execute(array($this->token));
          $user = $req->fetch(PDO::FETCH_ASSOC);
          if (!$user)
            return  $this->err_msg = "The link has expired.";
        self::password_check();
          if ($this->err_msg != NULL)
            return ;
          $sql = $this->conn->prepare("UPDATE `users` SET `uhpw`=? WHERE `token`=?");
          $stmt->execute(array(hash('whirlpool', $this->uhpw), $this->token));
          $this->err_msg = "Your password has been changed.";
        }
        catch (PDOException $error)
        {
            echo "Connection Failed: ". $error->getMessage();
            //die();
        }
    }
    public function db_connect()
        {
            try
            {
                $user = $this->fetch_user();
                if (!$user)
                    return $this->err_msg = "Cannot find this account. No cheese.";
                if ($user['verified'] == 0)
                    return $this->err_msg = "Your account has not been verified yet. <br /> Please check your email.";
                if ($user['uhpw'] != hash('whirlpool', $this->password))
                    return $this->err_msg = "Password incorrect. Wrong keys, no cheese.";
            }
            catch (PDOException $error)
            {
                echo "Connection Failed: ". $error->getMessage();
                //die();
            }
        }
    public function user_confirm()
    {
        try
        {
            if (new_user())
            {
                $this->token = bin2hex(random_bytes(16));
            }
        }
        catch (PDOException $error)
        {
            echo "Connection Failed: ". $error->getMessage();
            //die();
        }
    }
    public function send_pw()
        {
            try
            {
                $user = $this->fetch_user();
                if (!$user)
                    return $this->err_msg = "Cannot find this account.";
                $email = $user['email'];
                $token = bin2hex(random_bytes(16));
                $url = "localhost:8080/camagru/phppages/pw.php?q=" . $token;
                date_default_timezone_set('UTC');
                $doc = date("d/m/Y H:i:s");
                $tokenexpires = date("d/m/Y H:i:s", strtotime($doc . ' + 2 days'));
                $sql = $this->conn->prepare("UPDATE `users` SET `token`=?, `tokenexpires`=? WHERE `username`=?");
                $sql->execute(array($token, $tokenexpires, $this->user));
                $sql = $this->conn->prepare("UPDATE `users` SET `token`=?, `tokenexpires`=? WHERE `tokenexpires` < NOW() AND `verified`=1");
                $sql->execute(array(NULL, NULL));
                require_once '../pwd_email.php';
            }
            catch (PDOException $error)
            {
                die('Connection Failed' . $error->getMessage());
            }
        }
    }
?>
