<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title>Payment</title>
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

        <h1 class="mt-5">Payment</h1>

        <?php
        // Mengambil ID penerbangan dari URL
        $flight_id = isset($_GET['id']) ? $_GET['id'] : null;

        if ($flight_id) {
            // Muat data penerbangan dari file JSON
            $flights = json_decode(file_get_contents('Data/100_flights.json'), true);
            $selected_flight = null;

            // Mencari penerbangan yang dipilih berdasarkan ID
            foreach ($flights as $flight) {
                if ($flight['id'] == $flight_id) {
                    $selected_flight = $flight;
                    break;
                }
            }

            if ($selected_flight) {
                // Menampilkan detail penerbangan yang dipilih
                echo "<h3>Detail Penerbangan</h3>";
                echo "<p><strong>Maskapai:</strong> " . $selected_flight['maskapai'] . "</p>";
                echo "<p><strong>Tujuan:</strong> " . $selected_flight['destinasi'] . "</p>";
                echo "<p><strong>Keberangkatan:</strong> " . $selected_flight['jadwal_keberangkatan'] . "</p>";
                echo "<p><strong>Kedatangan:</strong> " . $selected_flight['jadwal_kedatangan'] . "</p>";
                echo "<p><strong>Harga:</strong> Rp " . number_format($selected_flight['harga'], 0, ',', '.') . "</p>";
                echo "<p><strong>Estimasi Sampai:</strong> " . $selected_flight['estimasi_penerbangan'] . "</p>";

                // Form pembayaran atau konfirmasi
                echo "<form action='process_payment.php' method='post'>";
                echo "<input type='hidden' name='flight_id' value='" . $selected_flight['id'] . "'>";
                echo "<input type='submit' value='Proceed to Payment' class='btn btn-primary'>";
                echo "</form>";
            } else {
                echo "Penerbangan tidak ditemukan.";
            }
        } else {
            echo "ID penerbangan tidak tersedia.";
        }
        ?>
    </div>
</body>
</html>
