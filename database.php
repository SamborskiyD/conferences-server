<?php
    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"], 1);

    class Database {

        private $url;
        public $server;
        public $username;
        public $password;
        public $db;


        public function dbConnect()
        {
            $this->$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
            $this->$server = $url["host"];
            $this->$username = $url["user"];
            $this->$password = $url["pass"];
            $this->$db = substr($url["path"], 1);

            try 
            {
                $conn = new PDO('mysql:host=' . $this->server . ';dbname=' . $this->db, $this->username, $this->password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $conn;
            } 
            catch (PDOException $e) 
            {
                echo "Connection error " . $e->getMessage();
            }
        }
    }
?>