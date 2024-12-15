<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title>Buy Ticket</title>
</head>
<body>
    <div class="container">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="index.php">Flight Booking System</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?route=buy_ticket">Buy Ticket</a>
                    </li>
                    <?php if (isset($_SESSION['user'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?route=logout">Logout</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?route=login">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?route=signup">Sign Up</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>

        <h1 class="mt-5">Buy Ticket</h1>

        <?php
        // Muat data penerbangan dari file JSON
        $flights = json_decode(file_get_contents('Data/100_flights.json'), true);
        ?>

        <table class="table">
            <thead>
                <tr>
                    <th>Airline</th>
                    <th>Destination</th>
                    <th>Departure</th>
                    <th>Arrival</th>
                    <th>Price</th>
                    <th>Estimated Arrival</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php
            // Mengambil data penerbangan dari file JSON
            $flights = json_decode(file_get_contents('Data/100_flights.json'), true);
            // Menampilkan daftar penerbangan
            foreach ($flights as $flight) {
                echo "<tr>";
                echo "<td>" . $flight['maskapai'] . "</td>";
                echo "<td>" . $flight['destinasi'] . "</td>";
                
                // Menambahkan pengecekan apakah key departure dan arrival ada
                $departure = isset($flight['jadwal_keberangkatan']) ? $flight['jadwal_keberangkatan'] : 'TBA';
                $arrival = isset($flight['jadwal_kedatangan']) ? $flight['jadwal_kedatangan'] : 'TBA';

                echo "<td>" . $departure . "</td>";
                echo "<td>" . $arrival . "</td>";
                
                // Mengubah harga menjadi format Rupiah
                echo "<td>Rp " . number_format($flight['harga'], 0, ',', '.') . "</td>";
                echo "<td>" . $flight['estimasi_penerbangan'] . "</td>";
                echo "<td><a href='payment.php?id=" . $flight['id'] . "'>Beli</a></td>";
                echo "</tr>";
            }
            ?>

            </tbody>
        </table>
    </div>
</body>
</html>
