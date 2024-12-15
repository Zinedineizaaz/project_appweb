<?php
class Ticket {
    private $db;

    public function __construct($db) {
        $this->db = $db->conn;
    }

    public function getAllAirlines() {
        $stmt = $this->db->query("SELECT * FROM airlines");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buyTicket($user_id, $airline_id, $flight_date, $price) {
        $stmt = $this->db->prepare("INSERT INTO tickets (user_id, airline_id, flight_date, price) VALUES (?, ?, ?, ?)");
        $stmt->execute([$user_id, $airline_id, $flight_date, $price]);
        return $this->db->lastInsertId();
    }
}
?>
