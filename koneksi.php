<?php
require_once 'vendor/autoload.php';

class Koneksi
{
    private $host;
    private $user;
    private $password;
    private $database;
    private $conn;

    function __construct()
    {
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
        $dotenv->load();

        // echo 'DB_HOST: ' . getenv('DB_HOST') . '<br>';
        // echo 'DB_USER: ' . getenv('DB_USER') . '<br>';
        // echo 'DB_PASSWORD: ' . getenv('DB_PASSWORD') . '<br>';
        // echo 'DB_DATABASE: ' . getenv('DB_DATABASE') . '<br>';

        $this->host = 'localhost';
        $this->user = 'root';
        $this->password = '';
        $this->database = 'asdp';

        $this->conn = $this->connection();
    }

    function get_url()
    {
        return "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER["REQUEST_URI"] . '?') . '/';
    }

    /**
     * Function connection()
     * Untuk koneksi ...
     * @return mysqli
     */
    function connection()
    {
        $conn = mysqli_connect($this->host, $this->user, $this->password, $this->database);

        if (!$conn) {
            die("Koneksi Gagal: " . mysqli_connect_error());
        }

        return $conn;
    }

    function query($sql)
    {
        $result = mysqli_query($this->conn, $sql);

        if (!$result) {
            die("Error in query: " . $this->error());
        }

        return $result;
    }

    function fetch_one_assoc($query)
    {
        return mysqli_fetch_assoc($query);
    }

    function fetch_all_assoc($query)
    {
        $data = [];

        while ($list = mysqli_fetch_assoc($query)) {
            $data[] = $list;
        }

        return $data;
    }

    function error()
    {
        return mysqli_error($this->conn);
    }

    function close()
    {
        mysqli_close($this->conn);
    }
}
