<?php
class Flight {
    private $conn;
    private $table_name = "flights";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllFlights() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
