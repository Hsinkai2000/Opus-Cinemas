<?php
include 'database_connection.php';
session_start();
$bookingIds = array();
$movieTimingIds = array();
$movieTimings = array();
$movieIds = array();
$movieTitles = array();
$moviePictures = array();
$cinemaIds = array();
$cinemaNames = array();

$stmt = $conn->prepare("SELECT * FROM bookings WHERE user_id = ? ");
$stmt->bind_param("s", $_SESSION['user_id']); 
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
  $bookingIds[] = $row["id"];
  $movieTimingIds[] = $row["movie_timing_id"];
}

foreach ($movieTimingIds as $movieTimingId) {
  $stmt = $conn->prepare("SELECT * FROM movie_timings WHERE id = ? ");
  $stmt->bind_param("s", $movieTimingId); 
  $stmt->execute();
  $result = $stmt->get_result();

  while ($row = $result->fetch_assoc()) {
    $movieTimings[] = $row["timing"];
    $cinemaIds[] = $row["cinema_id"];
    $movieIds[] = $row["movie_id"];
  }
}

foreach ($cinemaIds as $cinemaId) {
  $stmt = $conn->prepare("SELECT * FROM cinemas WHERE id = ? ");
  $stmt->bind_param("s", $cinemaId); 
  $stmt->execute();
  $result = $stmt->get_result();

  while ($row = $result->fetch_assoc()) {
    $cinemaNames[] = $row["name"];
  }
}

foreach ($movieIds as $movieId) {
  $stmt = $conn->prepare("SELECT * FROM movies WHERE id = ? ");
  $stmt->bind_param("s", $movieId); 
  $stmt->execute();
  $result = $stmt->get_result();

  while ($row = $result->fetch_assoc()) {
    $movieTitles[] = $row["title"];
    $moviePictures[] = $row["picture"];
  }
}

// echo "BookingIds: ";
// print_r($bookingIds);
// echo "<br> movieTimingIds: ";
// print_r($movieTimingIds);
// echo "<br> movieTimings: ";
// print_r($movieTimings);
// echo "<br> cinemaIds: ";
// print_r($cinemaIds);
// echo "<br> movieIds: ";
// print_r($movieIds);
// echo "<br> cinemaNames: ";
// print_r($cinemaNames);
// echo "<br> movieTitles: ";
// print_r($movieTitles);
// echo "<br> moviePictures: ";
// print_r($moviePictures);
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
      <h3>Upcoming</h3>

        <?php foreach ($bookingIds as $index => $bookingId) {
          $stmt = $conn->prepare("SELECT * FROM seats WHERE booking_id = ? ");
          $stmt->bind_param("s", $bookingId); 
          $stmt->execute();
          $result = $stmt->get_result();

          $seats = array();

          while ($row = $result->fetch_assoc()) {
            $seats[] = $row["seat"];
          }
        ?>
          <div class="movie-item">
              <img src="<?php echo htmlspecialchars($moviePictures[$index]); ?>" alt="<?php echo htmlspecialchars($movieTitles[$index]) . ' Poster'; ?>">
              <div class="movie-details">
                  <h3><?php echo htmlspecialchars($movieTitles[$index]); ?></h3>
                  <p>Time Slot: <?php echo htmlspecialchars($movieTimings[$index]); ?></p>
                  <p>Seats: <?php echo implode(", ", $seats); ?></p> 
              </div>
              <!-- <div class="button-container">
                  <button class="blue_button">View Ticket</button>
                  <button class="blue_button">View Invoice</button>
              </div> -->
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
