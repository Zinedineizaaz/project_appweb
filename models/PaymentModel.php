<?php
require_once 'Libraries/Database.php';

class PaymentModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function addPayment($data) {
        $this->db->query('INSERT INTO payments (flight_id, payment_method, card_number, name_on_card, total_amount)
                          VALUES (:flight_id, :payment_method, :card_number, :name_on_card, :total_amount)');
        $this->db->bind(':flight_id', $data['flight_id']);
        $this->db->bind(':payment_method', $data['payment_method']);
        $this->db->bind(':card_number', $data['card_number']);
        $this->db->bind(':name_on_card', $data['name_on_card']);
        $this->db->bind(':total_amount', $data['total_amount']);
        $this->db->execute();

        return $this->db->lastInsertId();
    }
}
