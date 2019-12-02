<?php
    class Likes
    {
        private $conn;
        private $imgid;
        private $user;
        public function __construct($imgid, $user)
        {
            try
            {
            require '../config/database.php';
            $this->conn = new PDO($dsn, $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->imgid = $imgid;
            $this->user = $userid;
            }
            catch (PDOException $error)
            {
                die('Connection Failed' . $error->getMessage());
            }
        }
        public function dbinsert_like()
        {
            try
            {
                date_default_timezone_set('UTC');
                $likedate = date("d/m/Y H:i:s");
                $sql = $this->conn->prepare("INSERT INTO `likes` (`imgid`, `userid`, `likedate`) VALUES (?, ?, ?)");
                $sql->execute(array($this->imgid, $this->user, $likedate));
            }
            catch (PDOException $error)
            {
                die('Connection Failed' . $error->getMessage());
            }
        }
        public function FetchAss_Like()
        {
            try
            {
                $sql = $this->conn->prepare("SELECT * FROM `likes` WHERE `imgid`=? AND `userid`=?");
                $stmt = $sql->execute(array($this->imgid, $this->user));
                return $sql->fetch(PDO::FETCH_ASSOC);
            }
            catch (PDOException $error)
            {
                die('Connection Failed' . $error->getMessage());
            }
        }
        public function like_count() 
        {
            try
            {
                $sql = $this->conn->sql("SELECT count(*) FROM `likes` WHERE `imgid` = $this->imgid");
                $like_count = $sql->fetch(PDO::FETCH_ASSOC);
                return $like_count['count(*)'];
            }
            catch (PDOException $error)
            {
                die('Connection Failed' . $error->getMessage());
            }
        }
        public function unlike_del()
        {
            try
            {
                $sql = $this->conn->prepare("DELETE FROM `likes` WHERE `imgid`=? AND `userid`=?");
                $sql->execute(array($this->imgid, $this->user));
            }
            catch (PDOException $error)
            {
                die('Connection Failed' . $error->getMessage());
            }
        }
        public function deleteAllLike()
        {
            try
            {
                $sql = $this->conn->prepare("DELETE FROM `likes` WHERE `imgid`=?");
                $sql->execute(array($this->imgid));
            }
            catch (PDOException $error)
            {
                die('Connection Failed' . $error->getMessage());
            }
        }
    }
?>