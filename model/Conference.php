<?php
    class Conference{

        private $conn;
        

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function getAll()
        {
            $query = "SELECT * FROM conferences ORDER BY date DESC";
            $stmt = $this->conn->prepare($query);

            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $data;
        }

        public function getById($id) 
        {
            $query = "SELECT * FROM conferences WHERE id= :id";
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':id', $id);

            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            return $data;
        }

        public function post($post_data)
        {
            $query = "INSERT INTO conferences (title,date,lat, lng,country) VALUES (:title,:date,:lat,:lng,:country)";

            $stmt = $this->conn->prepare($query);

            $stmt->bindValue(':title', $post_data->title, PDO::PARAM_STR);
            $stmt->bindValue(':date', $post_data->date, PDO::PARAM_STR);
            $stmt->bindValue(':lat', $post_data->lat, PDO::PARAM_LOB);
            $stmt->bindValue(':lng', $post_data->lng, PDO::PARAM_LOB);
            $stmt->bindValue(':country', $post_data->country, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt;
        }

        public function update($curr, $new)
        {

            $title = isset($new->title) ? $new->title : $curr["title"];
            $date= isset($new->date) ? $new->date : $curr["date"];
            $lat = isset($new->lat) ? $new->lat : $curr["lat"];
            $lng = isset($new->lng) ? $new->lng : $curr["lng"];
            $country = isset($new->country) ? $new->country : $curr["country"];

            $query = "UPDATE conferences SET title = :title, date = :date, lat = :lat, lng = :lng , country = :country
            WHERE id = :id";

            $stmt = $this->conn->prepare($query);

            $stmt->bindValue(':title', $title, PDO::PARAM_STR);
            $stmt->bindValue(':date', $date, PDO::PARAM_STR);
            $stmt->bindValue(':lat', $lat, PDO::PARAM_LOB);
            $stmt->bindValue(':lng', $lng, PDO::PARAM_LOB);
            $stmt->bindValue(':country', $country, PDO::PARAM_STR);
            $stmt->bindValue(':id', $new->id, PDO::PARAM_INT);

            $stmt->execute();
            return $stmt;

        }

        public function delete($id)
        {
            $query = "DELETE FROM conferences WHERE id=:id";

            $stmt = $this->conn->prepare($query);

            $stmt->bindValue(':id', $id, PDO::PARAM_INT);

            $stmt->execute();
            return $stmt;
        }
    }
?>