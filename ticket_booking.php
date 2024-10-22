<?php
include 'database_connection.php';
session_start();
$movie_id = $_GET['id'];

$movie_stmt = $conn->prepare("SELECT * FROM movies WHERE id = ?");
$movie_stmt->bind_param("i", $movie_id);

$movie_stmt->execute();
$result = $movie_stmt->get_result();
$movie = $result->fetch_assoc();

$movie_stmt->close();

$movie_location_stmt = $conn->prepare("SELECT DISTINCT c.name, c.id 
FROM cinemas c
JOIN movie_timings mt ON c.id = mt.cinema_id
WHERE mt.movie_id = ?");
$movie_location_stmt->bind_param("i", $movie_id);

$movie_location_stmt->execute();
$locationList = $movie_location_stmt->get_result();


$movie_location_stmt->close();


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
    <link rel="stylesheet" href="styles/ticket_booking.css">
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
        <?php
        if (!isset($_SESSION['user_id'])) { ?>
        <a class="navlink login" href="login.php">Login</a>
        <?php } else { ?>
        <a class="navlink login" href="account.php"><?php echo htmlspecialchars($_SESSION['email']); ?></a>
        <?php } ?>
    </header>

    <div class="wrapper">
        <img class="movie-image" src="<?php echo $movie['picture'] ?>" alt="<?php echo $movie['title'] ?>">
        <div class="booking-details">
            <h1><?php echo $movie['title']; ?></h1>

            <div class='right-page'>
                <span>Cinema</span>
                <br>
                <select name="cinema" id="selectCinema" onchange="fetchTiming()">
                    <?php foreach ($locationList as $location) {
                    ?>
                    <option value="<?php echo $location['id'] ?>"><?php echo $location['name'] ?></option>
                    <?php } ?>
                </select>

                <br>
                <br>
                <span>Time Slot</span>
                <br>

                <select name="timing" id="selectTiming" onchange="regenerateSeatingTable()">

                </select>

                <div class="seating">
                    <table class="seating-table">
                        <tr class="row first">
                            <th></th>
                            <?php for ($i = 1; $i <= 12; $i++): ?>
                            <?php if ($i == 6): ?>
                            <th colspan="2"></th>
                            <?php endif; ?>
                            <th><?= $i ?></th>
                            <?php endfor; ?>
                        </tr>
                    </table>
                </div>

                <div class="screen">Screen</div>

                <div class="legend">
                    <div class="legend-item">
                        <div class="seat-taken"></div>
                        <span>Seat Taken</span>
                    </div>
                    <div class="legend-item">
                        <div class="seat-available"></div>
                        <span>Seat Available</span>
                    </div>
                    <div class="legend-item">
                        <div class="seat-selected"></div>
                        <span>Seat Selected</span>
                    </div>
                </div>

                <table class="booking-prices">
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
                    <tr>
                        <td></td>
                        <td colspan="2">
                          <?php
                          if (isset($_SESSION['user_id'])) { ?>
                            <button class="blue_button" type="button" onclick="proceedToPayment()">Proceed to Payment</button>
                          <?php } else { ?>
                            <button class="blue_button" type="button"onclick="window.location.href='login.php'">Login/Signup to Proceed</button>
                          <?php } ?>
                        </td>
                    </tr>
                </table>

            </div>
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
            No.: 194700158Gf
        </p>
    </footer>
    <script src="scripts/ticket_booking.js" async defer></script>
    <script>
    window.movieId = <?php echo $movie_id; ?>;
    </script>
</body>

</html>