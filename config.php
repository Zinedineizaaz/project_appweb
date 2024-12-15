<?php
require_once 'Libraries/Database.php';

// Load data JSON
$json_file = 'data/flights.json';
$data = json_decode(file_get_contents($json_file), true);

// Koneksi database
$db = Database::getInstance();

// Import data ke database
foreach ($data as $flight) {
    $query = "INSERT INTO flights (airline, destination, departure_time, arrival_time, ticket_price, estimated_duration)
              VALUES (:airline, :destination, :departure_time, :arrival_time, :ticket_price, :estimated_duration)";
    $stmt = $db->prepare($query);
    $stmt->execute([
        ':airline' => $flight['airline'],
        ':destination' => $flight['destination'],
        ':departure_time' => $flight['departure_time'],
        ':arrival_time' => $flight['arrival_time'],
        ':ticket_price' => $flight['ticket_price'],
        ':estimated_duration' => $flight['estimated_duration']
    ]);
}

echo "Data imported successfully!";
?>

