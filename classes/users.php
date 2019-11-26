<?php

class users
{
    private $username;
    private $conn;
    private $email;
    private $password;
    private $confirmpassword;
    private $token;
    private $err_msg;

    public function __construct($username, $password, $email, $confirmpassword, $token)
    {
        try
        {
            require_once "../config/setup.php";
            $this->conn = new PDO($dsn, $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->username = $username;
            $this->email = $email;
            $this->uhpw = $password;
            $this->confirmpassword = $confirmpassword;
            $this->token = $token;
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
            $stmt->execute(array($this->username));
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
                return $this->err_msg = "Incorrect password";
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
            if (strlen($this->username) > 30)
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
}

?>
