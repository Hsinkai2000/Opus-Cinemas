<?php
include 'database_connection.php';
session_start();
// Retrieve the stored values from the session
$seatsArray = isset($_SESSION['selected_seats']) ? $_SESSION['selected_seats'] : [];
$cinemaId = isset($_SESSION['cinema_id']) ? $_SESSION['cinema_id'] : null;
$movieId = isset($_SESSION['movie_id']) ? $_SESSION['movie_id'] : null;
$timing = isset($_SESSION['timing']) ? $_SESSION['timing'] : null;

$movie_sql = "SELECT * FROM movies where id = " . $movieId;
$movie_result = $conn->query($movie_sql);

while ($row = $movie_result->fetch_assoc()) {
  $title = $row["title"];
  $picture = $row["picture"];
}

$cinema_sql = "SELECT * FROM cinemas where id = " . $cinemaId;
$cinema_result = $conn->query($cinema_sql);

while ($row = $cinema_result->fetch_assoc()) {
  $cinema = $row["name"];
}

$movie_timing_id_sql = "SELECT * FROM movie_timings WHERE movie_id = ? AND cinema_id = ? and timing = ?";
$stmt = $conn->prepare($movie_timing_id_sql);

// Bind the parameters securely
$stmt->bind_param("iis", $movieId, $cinemaId, $timing);

// Execute the query
$stmt->execute();

// Fetch results
$movie_timing_result = $stmt->get_result();
while ($row = $movie_timing_result->fetch_assoc()) {
  $movie_timing_id = $row["id"];
}

$seatsCount = count($seatsArray);
$serializedSeats = serialize($seatsArray);
?>
<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Opus | Payment</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles/global.css">
    <link rel="stylesheet" href="styles/payment.css">
  </head>

<body>

  <header>
    <h3>Opus Cinemas</h3>
    <div>
      <ul class="nav">
        <li class="navlink"><a class="active" href="home.php">Home</a></li>
        <li class="navlink"><a href="cinemas.php">Cinemas</a></li>
        <li class="navlink"><a href="now_showing.php">Now Showing</a></li>
      </ul>
    </div>

      <?php if (!isset($_SESSION['user_id'])) { ?>
        <a class="navlink login" href="login.php">Login</a>
      <?php } else { ?>
        <a class="navlink login" href="account.php"><?php echo htmlspecialchars($_SESSION['email']); ?></a>
      <?php } ?>
  </header>
    <div class="wrapper">
      <img class="movie-image" src="<?php echo $picture?>" alt="Movie">
      <div class="content">
          <div class="booking-details">
            <h2><?php echo $title; ?></h2>
            <table class="booking-prices">
              <tr>
                <td>
                  <h3>Cinema:</h3>
                </td>
                <td>
                  <span"><?php echo $cinema?></span>
                </td>
                <td></td>
              </tr>

              <tr>
                <td>
                  <h3>Time Slot:</h3>
                </td>
                <td>
                  <span"><?php echo $timing?></span>
                </td>
                <td></td>
              </tr>

              <tr>
                <td>
                  <h3>Seats:</h3>
                </td>
                <td>
                  <span id="selected-seats"><?php echo implode(", ", $seatsArray); ?></span>
                </td>
                <td></td>
              </tr>

              <tr>
                <td>
                  <h3>Price:</h3>
                </td>
                <td>
                  <span id="standardTicketLabel">Standard Ticket x <?php echo $seatsCount;?></span>
                </td>
                <td>
                  <span id="standardTicketAmt">$9.00 x <?php echo $seatsCount;?></span>
                </td>
              </tr>

              <tr>
                <td>
                  
                </td>
                <td>
                  <span>GST 7%</span>
                </td>
                <td>
                  <span id="gstAmt">$<?php echo (0.07 * $seatsCount * 9);?></span>
                </td>
              </tr>

              <tr>
                <td>
                </td>
                <td>
                  <span style="text-decoration: underline;">Total</span>
                </td>
                <td>
                  <span id="totalAmt">$<?php echo ($seatsCount * 9 * 1.07);?></span>
                </td>
              </tr>
                      
            </table>
          </div>
          
          <div class="cards">
            <h4 class="card-details" style="text-decoration: underline;">Card Details</h4>
            <div class="card-logos">
              <img src="assets/cards/mastercard.png" alt="MasterCard">
              <img src="assets/cards/visa.png" alt="Visa">
              <img src="assets/cards/maestro.png" alt="Maestro">
              <img src="assets/cards/american_express.png" alt="American Express">
            </div>
          </div>

          <div class="payment-details">
        
          <form action="bookings.php" method="post">
            <label for="email">Name on Card:</label>
            <input type="text" name="name-on-card" placeholder="Enter your name" required />
            <label for="card-number">Card Number</label>
            <input type="tel" name="card-number" inputmode="numeric" pattern="[0-9]*" maxlength="16" placeholder="Enter card number" required>

            <div class="card-inputs">
              <div class="input-group">
                <label for="expiry-date">Expiry Date</label>
                <input type="text" id="expiry-date" name="expiry-date" placeholder="MM / YY" maxlength="7">
              </div>
              <div class="input-group">
                <label for="security-code">Security Code</label>
                <input type="text" id="security-code" name="security-code" placeholder="CVV" maxlength="4">
              </div>
            </div>

            <h4 class="personal-details" style="text-decoration: underline;">Personal Details</h4>

            <label for="name">Name</label>
            <input type="text" placeholder="Your Name" name="name" required />
            <label for="name">Email</label>
            <input type="email" name="email" placeholder="Enter Email" required />
            <input type="hidden" name="movie_timing_id" value="<?php echo $movie_timing_id;?>">
            <input type="hidden" name="price" value="<?php echo ($seatsCount * 9 * 1.07);?>">
            <input type="hidden" name="userId" value="<?php echo $_SESSION['user_id'];?>">
            <input type="hidden" name="seats" value="<?php echo htmlspecialchars($serializedSeats); ?>">
            <input type="hidden" name="timing" value="<?php echo $timing;?>">
            <input type="hidden" name="title" value="<?php echo $title;?>">
            <input type="hidden" name="cinema" value="<?php echo $cinema;?>">



            <div class="actions">
              <button type="submit" name="pay" id="payButton" class="blue_button">Pay</button>
            </div>
          </form>
          </div>
      </div>
    </div>
   
    <footer>
      <div class="footerlink">
        <a href="#">About</a>
        <a href="#">Privacy Policy</a>
        <a href="#">Career Opportunities</a>
        <a href="#">Terms of Use</a>
        <a href="support.php">Contact Us</a>
      </div>
      <p>
        © Copyright 2024 Opus Cinemas. All rights reserved. Co. Reg.
        No.: 194700158G
      </p>
    </footer>

    <script src="scripts/ticket_booking.js" async defer></script>
    <script>

    </script>
</body>

</html>
