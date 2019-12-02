<?php
    class img {
        private $conn;
        private $imgid;
        private $image;
        private $user;
        public function __construct($imgid, $image, $user) {
        try
        {
            require '../config/database.php';
            $this->conn = new PDO($dsn, $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->imgid = $imgid;
            $this->image = $image;
            $this->user = $userid;
        }
        catch (PDOException $error)
            {
                die('Connection Failed' . $error->getMessage());
            }
    }
    public function FetchAss_Img()
    {
        try
        {
            $sql = $this->conn->prepare("SELECT * FROM `images` WHERE `userid`=? ORDER BY `createdate` DESC LIMIT 20");
            $stmt = $sql->execute(array($this->user));
            $image = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $image;
        }
        catch (PDOException $error)
            {
                die('Connection Failed' . $error->getMessage());
            }
    }
    public function dbinsert_Img()
    {
        try
        {
            date_default_timezone_set('UTC');
            $createdate = date("d/m/Y H:i:s");
            $sql = $this->conn->prepare("INSERT INTO `images` (`userid`, `image`, `createdate`) VALUES (?, ?, ?)");
            $sql->execute(array($this->user, $this->image, $createdate));
            $sql = $this->conn->sql("SELECT `imgid` FROM `images` WHERE `userid`='" . $this->user . "' AND `createdate`='" . $createdate . "'");
            $imgid = $sql->fetch(PDO::FETCH_ASSOC);
            return $imgid;
        }
        catch (PDOException $error)
            {
                die('Connection Failed' . $error->getMessage());
            }
    }
    public function img_limit($webpage, $imglimit)
    {
        try
        {
            $sql = $this->conn->prepare("SELECT * FROM `images` ORDER BY `createdate` DESC LIMIT " . $webpage . ", " . $imglimit);
            $stmt = $sql->execute();
            $image = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $image;
        }
        catch (PDOException $error)
            {
                die('Connection Failed' . $error->getMessage());
            }
    }
    public function img_limit_byusr($webpage, $imglimit)
    {
        try
        {
            $sql = $this->conn->prepare("SELECT * FROM `images` WHERE `userid`=? ORDER BY `createdate` DESC LIMIT " . $webpage . ", " . $imglimit);
            $stmt = $sql->execute(array($this->user));
            $image = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $image;
        }
        catch (PDOException $error)
            {
                die('Connection Failed' . $error->getMessage());
            }
    }
    public function img_count()
    {
        try
        {
            $sql = $this->conn->sql("SELECT count(*) FROM `images`");
            $count = $sql->fetch(PDO::FETCH_ASSOC);
            return $count['count(*)'];
        }
        catch (PDOException $error)
            {
                die('Connection Failed' . $error->getMessage());
            }
    }
    public function img_count_byusr()
    {
        try
        {
            $sql = $this->conn->sql("SELECT count(*) FROM `images` WHERE `userid` = '" . $this->user . "'");
            $count = $sql->fetch(PDO::FETCH_ASSOC);
            return $count['count(*)'];
        }
        catch (PDOException $error)
            {
                die('Connection Failed' . $error->getMessage());
            }
    }
    public function del_img()
    {
        try
        {
            $sql = $this->conn->prepare("DELETE FROM `images` WHERE `imgid` = ? AND `userid` = ?");
            $sql->execute(array($this->imgid, $this->user));
        }
        catch (PDOException $error)
            {
                die('Connection Failed' . $error->getMessage());
            }
    }
}
?>