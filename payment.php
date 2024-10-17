<?php
include 'database_connection.php';
session_start();




?>
<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Opus | <?php echo $movie['title'] ?></title>
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
        <a class="navlink login" href="logout.php"><?php echo htmlspecialchars($_SESSION['email']); ?></a>
      <?php } ?>
  </header>

    <?php 
      
  
        // Get the raw POST data (JSON format)
        $json = file_get_contents('php://input');
        
        // Decode the JSON data to a PHP associative array
        $postData = json_decode($json, true);
        
        // Extract individual data points from the associative array
        $seats = isset($postData['seats']) ? $postData['seats'] : [];
        $cinema_id = isset($postData['cinema_id']) ? $postData['cinema_id'] : '';
        $movie_id = isset($postData['movie_id']) ? $postData['movie_id'] : '';
        $timing = isset($postData['timing']) ? $postData['timing'] : '';
    
        // Example of printing the data (useful for debugging)
        echo "Seats: " . implode(", ", $seats) . "<br>";
        echo "Cinema ID: " . htmlspecialchars($cinema_id) . "<br>";
        echo "Movie ID: " . htmlspecialchars($movie_id) . "<br>";
        echo "Timing: " . htmlspecialchars($timing) . "<br>";
    
      
    ?>

    <div class="wrapper">
      <img class="movie-image" src="assets/covers/avatar_the_last_airbender_cover.png" alt="<?php echo $movie['title'] ?>">
      <div class="content">
          <div class="booking-details">
            <h2>Avatar: The Last Airbender</h2>
            <table class="booking-prices">
              <tr>
                <td>
                  <h3>Time Slot:</h3>
                </td>
                <td>
                  <span id="selected-seats">-</span>
                </td>
                <td></td>
              </tr>

              <tr>
                <td>
                  <h3>Seats:</h3>
                </td>
                <td>
                  <span id="selected-seats">-</span>
                </td>
                <td></td>
              </tr>

              <tr>
                <td>
                  <h3>Price:</h3>
                </td>
                <td>
                  <span id="standardTicketLabel">Standard Ticket x [add qty]</span>
                </td>
                <td>
                  <span id="standardTicketAmt">$9.00 x [add qty]</span>
                </td>
              </tr>

              <tr>
                <td>
                </td>
                <td>
                  <span>GST 7%</span>
                </td>
                <td>
                  <span id="gstAmt">$[calculateGST]</span>
                </td>
              </tr>

              <tr>
                <td>
                </td>
                <td>
                  <span style="text-decoration: underline;">Total</span>
                </td>
                <td>
                  <span id="totalAmt">$[calculate total]</span>
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
        
          <form>
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
            


            <div class="actions">
              <button type="submit" name="pay" id="payButton" class="blue_button">
                Pay
              </button>
              
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
    window.movieId = <?php echo $movie_id; ?>;
    </script>
</body>

</html>