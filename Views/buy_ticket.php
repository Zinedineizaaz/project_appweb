<?php
// Membaca file JSON
$data = file_get_contents('100_flights.json');
$flights = json_decode($data, true);

// Inisialisasi variabel filter
$filtered_flights = $flights;
$search_airline = $_GET['airline'] ?? '';
$search_date = $_GET['departure_date'] ?? '';
$search_price = $_GET['max_price'] ?? '';
$search_time = $_GET['departure_time'] ?? '';

// Filter data berdasarkan input pengguna
if (!empty($search_airline)) {
    $filtered_flights = array_filter($filtered_flights, function ($flight) use ($search_airline) {
        return stripos($flight['airline'], $search_airline) !== false;
    });
}

if (!empty($search_date)) {
    $filtered_flights = array_filter($filtered_flights, function ($flight) use ($search_date) {
        return strpos($flight['departure_time'], $search_date) === 0;
    });
}

if (!empty($search_price)) {
    $filtered_flights = array_filter($filtered_flights, function ($flight) use ($search_price) {
        return $flight['price'] <= $search_price;
    });
}

if (!empty($search_time)) {
    $filtered_flights = array_filter($filtered_flights, function ($flight) use ($search_time) {
        $departure_time = date('H:i', strtotime($flight['departure_time']));
        return $departure_time >= $search_time;
    });
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Ticket</title>
    <link href="/project_appweb/Assets/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="/project_appweb/Assets/js/bootstrap.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Buy Ticket</h2>
        <form method="GET" class="mb-4">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="airline">Airline</label>
                    <input type="text" class="form-control" name="airline" id="airline" value="<?= htmlspecialchars($search_airline) ?>" placeholder="Airline">
                </div>
                <div class="form-group col-md-3">
                    <label for="departure_date">Departure Date</label>
                    <input type="date" class="form-control" name="departure_date" id="departure_date" value="<?= htmlspecialchars($search_date) ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="max_price">Max Price (IDR)</label>
                    <input type="number" class="form-control" name="max_price" id="max_price" value="<?= htmlspecialchars($search_price) ?>" placeholder="Max Price">
                </div>
                <div class="form-group col-md-3">
                    <label for="departure_time">Departure Time (HH:mm)</label>
                    <input type="time" class="form-control" name="departure_time" id="departure_time" value="<?= htmlspecialchars($search_time) ?>">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Airline</th>
                    <th>Origin</th>
                    <th>Destination</th>
                    <th>Departure Time</th>
                    <th>Arrival Time</th>
                    <th>Price (IDR)</th>
                    <th>Duration</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($filtered_flights)): ?>
                    <?php foreach ($filtered_flights as $flight): ?>
                        <tr>
                            <td><?= htmlspecialchars($flight['airline']) ?></td>
                            <td><?= htmlspecialchars($flight['origin']) ?></td>
                            <td><?= htmlspecialchars($flight['destination']) ?></td>
                            <td><?= htmlspecialchars($flight['departure_time']) ?></td>
                            <td><?= htmlspecialchars($flight['arrival_time']) ?></td>
                            <td><?= number_format($flight['price'], 0, ',', '.') ?></td>
                            <td><?= htmlspecialchars($flight['estimated_duration']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">No flights found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
