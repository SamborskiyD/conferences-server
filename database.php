<?php

    class Database {

        private $url = null;
        private $server = null;
        private $username = null;
        private $password = null;
        private $db = null;


        public function dbConnect()
        {
            $this->url = parse_url(getenv("CLEARDB_DATABASE_URL"));
            $this->server = $this->url["host"];
            $this->username = $this->url["user"];
            $this->password = $this->url["pass"];
            $this->db = substr($this->url["path"], 1);

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