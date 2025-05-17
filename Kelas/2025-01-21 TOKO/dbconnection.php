<?php
class Database
{
    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $database = 'nama_database';
    private $koneksi;

    public function __construct()
    {
        $this->koneksi = $this->koneksiDB();
    }

    public function koneksiDB()
    {
        $koneksi = mysqli_connect($this->host, $this->user, $this->password, $this->database);
        if (!$koneksi) {
            die('Koneksi gagal: ' . mysqli_connect_error());
        }
        return $koneksi;
    }

    public function getALL($sql)
    {
        $result = mysqli_query($this->koneksi, $sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    public function getITEM($sql)
    {
        $result = mysqli_query($this->koneksi, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    public function rowCOUNT($sql)
    {
        $result = mysqli_query($this->koneksi, $sql);
        $count = mysqli_num_rows($result);
        return $count;
    }

    public function runSQL($sql)
    {
        mysqli_query($this->koneksi, $sql);
    }

    public function pesan($text = "")
    {
        echo $text;
    }

    public function checkConnectionStatus()
    {
        $query = "SELECT 1";
        $result = mysqli_query($this->koneksi, $query);
        if ($result) {
            return 'Koneksi aktif';
        } else {
            return 'Koneksi tidak aktif';
        }
    }
}
