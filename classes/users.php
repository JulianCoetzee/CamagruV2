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
            $this->$conn = new PDO($dsn, $username, $password);
            $this->$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
            $stmt = $this->$conn->prepare($sql);
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
            if (strlen($this->password) > 255)
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
                return $this->err_msg = "Incorrect pasword";
        }
        catch (PDOException $error) 
        {
            echo "Connection Failed: ". $error->getMessage();
            //die();
        }
    }
    public function user_confirm()
}

?>
