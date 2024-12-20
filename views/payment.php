<?php
if (isset($_GET['id'])) {
    $flight_id = $_GET['id'];

    // Baca file JSON untuk mendapatkan data penerbangan berdasarkan ID
    $jsonData = file_get_contents('100_flights.json');
    $flights = json_decode($jsonData, true);

    $selectedFlight = null;
    foreach ($flights as $flight) {
        if ($flight['id'] == $flight_id) {
            $selectedFlight = $flight;
            break;
        }
    }

    if (!$selectedFlight) {
        die("<p>Flight not found.</p>");
    }
} else {
    die("<p>Invalid request.</p>");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Assets/css/bootstrap.min.css">
    <title>Payment</title>
</head>
<body>
    <h1>Payment for Flight</h1>
    <p><strong>Airline:</strong> <?= $selectedFlight['airline'] ?></p>
    <p><strong>Destination:</strong> <?= $selectedFlight['destination'] ?></p>
    <p><strong>Price:</strong> IDR <?= number_format($selectedFlight['price'], 0, ',', '.') ?></p>

    <form action="buy.php" method="POST">
        <input type="hidden" name="flight_id" value="<?= $flight_id ?>">
        <input type="hidden" name="price" value="<?= $selectedFlight['price'] ?>">
        
        <div class="form-group">
            <label for="payment_method">Payment Method</label>
            <select name="payment_method" id="payment_method" required>
                <option value="">Select a method</option>
                <option value="Credit Card">Credit Card</option>
                <option value="Debit Card">Debit Card</option>
                <option value="E-Wallet">E-Wallet</option>
            </select>
        </div>
        <div class="form-group">
            <label for="card_number">Card Number</label>
            <input type="text" name="card_number" id="card_number" required>
        </div>
        <div class="form-group">
            <label for="name_on_card">Name on Card</label>
            <input type="text" name="name_on_card" id="name_on_card" required>
        </div>

        <button type="submit">Proceed to Buy</button>
    </form>
</body>
</html>
