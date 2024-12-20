<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Assets/css/bootstrap.min.css">
    <title>Buy Ticket</title>
</head>
<body>
    <h1>Available Flights</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Airline</th>
                <th>Destination</th>
                <th>Departure</th>
                <th>Arrival</th>
                <th>Duration</th>
                <th>Price (IDR)</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Baca file JSON
            $jsonData = file_get_contents('Data/100_flights.json');
            $flights = json_decode($jsonData, true);

            // Tampilkan data dalam tabel
            foreach ($flights as $flight) {
                echo "<tr>
                    <td>{$flight['id']}</td>
                    <td>{$flight['airline']}</td>
                    <td>{$flight['destination']}</td>
                    <td>{$flight['departure_time']}</td>
                    <td>{$flight['arrival_time']}</td>
                    <td>{$flight['flight_duration']}</td>
                    <td>" . number_format($flight['price'], 0, ',', '.') . "</td>
                    <td><a class='buy-button' href='buy.php?id={$flight['id']}'>Buy</a></td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
