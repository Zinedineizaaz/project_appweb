<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title>Homepage</title>
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

        <h1 class="mt-5">Welcome to the Flight Booking System</h1>

        <p>If you are ready to buy a ticket, just click the button below.</p>
        <a href="index.php?route=buy_ticket" class="btn btn-success">Go to Buy Ticket</a>
    </div>
</body>
</html>
