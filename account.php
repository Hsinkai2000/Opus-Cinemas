<?php
include 'database_connection.php';
session_start();

$sortOrder = 'ASC';
$empty = true;


if (isset($_GET['sort']) && ($_GET['sort'] == 'asc' || $_GET['sort'] == 'desc')) {
  $sortOrder = strtoupper($_GET['sort']);
}

$movies = array();

$stmt = $conn->prepare("SELECT bookings.id AS booking_id, movie_timings.timing, cinemas.name AS cinema_name, movies.title, movies.picture 
                        FROM bookings 
                        JOIN movie_timings ON bookings.movie_timing_id = movie_timings.id
                        JOIN movies ON movie_timings.movie_id = movies.id
                        JOIN cinemas ON movie_timings.cinema_id = cinemas.id
                        WHERE bookings.user_id = ?
                        ORDER BY movie_timings.timing $sortOrder");
$stmt->bind_param("s", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
  $movies[] = [
    "booking_id" => $row["booking_id"],
    "timing" => $row["timing"],
    "cinema_name" => $row["cinema_name"],
    "movie_title" => $row["title"],
    "movie_picture" => $row["picture"],
  ];
  $empty = false;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/account.css?v=1">
    <link rel="stylesheet" href="styles/global.css?v=1">
    <title>Opus | Account </title>
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
        <a class="navlink login" href="logout.php">Logout</a>
        <?php } ?>
    </header>

    <div class="wrapper">
        <section>
            <?php if (!$empty) { ?>
            <h3>Upcoming</h3>
            <!-- Sorting buttons -->
            <div class="sorting-buttons">
                <a href="?sort=asc" class="sort-button">Sort by Time (ASC)</a>
                <a href="?sort=desc" class="sort-button">Sort by Time (DESC)</a>
            </div>

            <?php } else { ?>
            <h3>You have not made any bookings.</h3>
            <?php } ?>

            <?php foreach ($movies as $movie) {
        $stmt = $conn->prepare("SELECT seat FROM seats WHERE booking_id = ? ");
        $stmt->bind_param("s", $movie['booking_id']);
        $stmt->execute();
        $result = $stmt->get_result();

        $seats = array();
        while ($row = $result->fetch_assoc()) {
          $seats[] = $row["seat"];
        }
      ?>
            <div class="movie-item">
                <img src="<?php echo htmlspecialchars($movie['movie_picture']); ?>"
                    alt="<?php echo htmlspecialchars($movie['movie_title']) . ' Poster'; ?>">
                <div class="movie-details">
                    <h3><?php echo htmlspecialchars($movie['movie_title']); ?></h3>
                    <p>Time Slot: <?php echo htmlspecialchars($movie['timing']); ?></p>
                    <p>Seats: <?php echo implode(", ", $seats); ?></p>
                </div>
            </div>
            <?php } ?>
        </section>
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