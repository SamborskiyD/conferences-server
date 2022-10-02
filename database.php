<?php
    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"], 1);

    class Database {
        public function dbConnect()
        {
            try 
            {
                $conn = new PDO('mysql:host=' . $server . ';dbname=' . $db, $username, $password);
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