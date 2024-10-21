<?php
include 'database_connection.php';
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/account.css?v=1">
    <link rel="stylesheet" href="styles/global.css?v=1">
    <title>Booking Management</title>
</head>
<body>
  <header>
    <h3 class="opus-name">Opus Cinemas</h3>
    <div>
      <ul class="nav">
        <li class="navlink"><a href="home.php">Home</a></li>
        <li class="navlink"><a class="navlink" href="cinemas.php">Cinemas</a></li>
        <li class="navlink"><a href="now_showing.php">Now Showing</a></li>
      </ul>
    </div>
    <?php
    if (!isset($_SESSION['user_id'])) { ?>
        <a class="navlink login" href="login.php">Login</a>
    <?php } else { ?>
        <a class="navlink login" href="logout.php"><?php echo htmlspecialchars($_SESSION['email']); ?></a>
    <?php } ?>
  </header>

    <div class="wrapper">
        <section>
            <h3>Upcoming</h3>
            <div class="movie-item">
                <img src="assets/covers/avatar_the_last_airbender_cover.png" alt="Avatar: The Last Airbender Poster">
                <div class="movie-details">
                    <h3>Avatar: The Last Airbender</h3>
                    <p>Time Slot: 1:30 PM</p>
                    <p>Seats: A1, A2</p>
                </div>
                <div class="button-container">
                    <button class="blue_button">View Ticket</button>
                    <button class="blue_button">View Invoice</button>
                </div>
            </div>
        </section>

        <!-- <section>
            <h3>History</h3>
            <div class="movie-item">
                <img src="assets/covers/inside_out_2_cover.png" alt="Inside Out 2 Poster">
                <div class="movie-details">
                    <h3>Inside Out 2</h3>
                    <p>Time Slot: 2:30 PM</p>
                    <p>Seats: C5</p>
                </div>
                <div class="button-container">
                    <button class="blue_button">View Invoice</button>
                </div>
            </div>
            <div class="movie-item">
                <img src="assets/covers/wonka_cover.png" alt="Wonka Poster">
                <div class="movie-details">
                    <h3>Wonka</h3>
                    <p>Time Slot: 1:30 PM</p>
                    <p>Seats: A1, A2</p>
                </div>
                <div class="button-container">
                    <button class="blue_button">View Invoice</button>
                </div>
            </div>
        </section> -->
    </div>

    <footer>
        <div class="footerlink">
            <a href="#">FAQ</a>
            <a href="#">About</a>
            <a href="#">Privacy Policy</a>
            <a href="#">Career Opportunities</a>
            <a href="#">Terms of Use</a>
            <a href="#">Contact Us</a>
        </div>
        <p>&copy; Copyright 2024 Organisation. All rights reserved. Co. Reg. No: 194700158G</p>
    </footer>
</body>
</html>
