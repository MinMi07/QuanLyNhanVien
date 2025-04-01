<?php class SQL
{
    var $locahost;
    var $user;
    var $pass;
    var $database;
    function __construct()
    {
        $this->locahost = "localhost";
        $this->user = "root";
        $this->pass = "";
        $this->database = 'quan_ly_nhan_vien';
    }
    public function getconnect()
    {
        try {
            return new mysqli($this->locahost, $this->user, $this->pass, $this->database);
        } catch (Exception $e) {
            echo $e;
        }
    }
    public function exe($query)
    {
        $sql = $this->getconnect();
        if ($sql->query($query) === TRUE) {
            $sql->close();
            return true;
        } else {
            $sql->close();
            return false;
        }
    }
    public function getdata($query)
    {
        $sql = $this->getconnect();
        $data = $sql->query($query);
        $sql->close();
        return $data;
    }
}
