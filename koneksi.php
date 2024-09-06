<?php
class Koneksi
{
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "asdp";
    private $conn;

    function __construct()
    {
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
?>
