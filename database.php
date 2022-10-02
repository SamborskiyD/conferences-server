<?php
    class Database {
        private $host = "localhost";
        private $db_name = "testbwt";
        private $username = "root";
        private $password = "";

        public function dbConnect()
        {
            try 
            {
                $conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
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