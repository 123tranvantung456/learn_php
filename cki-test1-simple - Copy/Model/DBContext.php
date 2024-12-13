<?php
class DBContext
{
    private $host = "localhost";
    private $username = "root";
    private $password = "123456";
    private $database = "test1";
    protected $connection;

    public function __construct()
    {
        $this->connection = $this->connect();
    }

    private function connect()
    {
        $conn = mysqli_connect($this->host, $this->username, $this->password, $this->database);

        if (!$conn) {
            die("Could not connect to MySQL: " . mysqli_connect_error());
        }

        return $conn;
    }

    public function closeConnection()
    {
        if ($this->connection) {
            mysqli_close($this->connection);
        }
    }
}
?>