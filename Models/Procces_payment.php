<?php
session_start();

if (isset($_POST['flight_id']) && isset($_SESSION['user'])) {
    $flight_id = $_POST['flight_id'];
    $flights = json_decode(file_get_contents('data/flights.json'), true);

    // Cari penerbangan berdasarkan ID
    $flight = null;
    foreach ($flights as $f) {
        if ($f['id'] == $flight_id) {
            $flight = $f;
            break;
        }
    }

    if ($flight) {
        echo "Payment successful! You have booked a flight to " . htmlspecialchars($flight['destination']) . ".";
    } else {
        echo "Flight not found.";
    }
} else {
    echo "Please login first.";
}
?>
