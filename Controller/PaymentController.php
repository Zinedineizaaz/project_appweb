<?php

class PaymentController {
    public function payment() {
        if (isset($_GET['flight_id'])) {
            // Ambil ID penerbangan dari query string
            $flight_id = $_GET['flight_id'];

            // Muat data penerbangan dari JSON
            $flights = json_decode(file_get_contents('Data/100_flights.json'), true);

            // Cari penerbangan berdasarkan ID
            $flight = null;
            foreach ($flights as $f) {
                if ($f['id'] == $flight_id) {
                    $flight = $f;
                    break;
                }
            }

            if ($flight) {
                include 'Views/payment.php';
            } else {
                echo "Flight not found.";
            }
        } else {
            echo "No flight selected.";
        }
    }
}

?>