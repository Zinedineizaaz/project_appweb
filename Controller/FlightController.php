<?php

class FlightController {
    public function buyTicket() {
        // Memuat data penerbangan dari file JSON
        $flights = json_decode(file_get_contents('Data/100_flights.json'), true);
        
        include 'Views/buy_ticket.php';
    }
}

?>