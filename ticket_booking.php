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

$movie_timing_stmt = $conn->prepare("SELECT * from movie_timings where movie_id = ?");
$movie_timing_stmt->bind_param("i", $movie_id);

$movie_timing_stmt->execute();
$timing_result = $movie_timing_stmt->get_result();

$movie_timing_stmt->close();


?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Opus | <?php echo $movie['title'] ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="
https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js
"></script>
    <link href="
https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css
" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="styles/global.css">
    <link rel="stylesheet" href="styles/ticket_booking.css">
</head>

<body>
    <header>
        <h3>Opus Cinemas</h3>
        <div>
            <ul class="nav">
                <li class="navlink">
                    <a class="active" href="home.php">Home</a>
                </li>
                <li class="navlink"><a href="cinemas.php">Cinemas</a></li>
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
        <img class="movie-image" src="<?php echo $movie['picture'] ?>" alt="<?php echo $movie['title'] ?>">
        <div class="booking-details">
            <h1><?php echo $movie['title']; ?></h1>

            <span>Cinema</span>
            <br>
            <section class="splide" id="cinemaSplide">
                <div class="splide__track">
                    <ul class="splide__list">
                        <?php
                        while ($row = $locationList->fetch_assoc()) {
                        ?>
                            <li class="splide__slide">
                                <input type="radio" id="cinema_<?php echo $row['id']; ?>" name="movie"
                                    value="<?php echo $row['name']; ?>" onchange="check2()">
                                <label for="cinema_<?php echo $row['id']; ?>"
                                    class="genre_bubble"><?php echo $row['name']; ?></label>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </section>


            <span>Time Slot</span>
            <br>
            <section class="splide" id="timeSplide">
                <div class="splide__track">
                    <ul class="splide__list">
                        <?php
                        while ($row = $timing_result->fetch_assoc()) {
                        ?>
                            <li class="splide__slide">
                                <input type="radio" id="genre_<?php echo $row['id']; ?>" name="genre"
                                    value="<?php echo $row['timing']; ?>" onchange="check()">
                                <label for="genre_<?php echo $row['id']; ?>"
                                    class="genre_bubble"><?php echo $row['timing']; ?></label>
                            </li>

                        <?php } ?>
                    </ul>
                </div>
            </section>

        </div>
    </div>



    <footer>
        <div class="footerlink">
            <a href="#">About</a>
            <a href="#">Privacy Policy</a>
            <a href="#">Career Opportunities</a>
            <a href="#">Terms of Use</a>
            <a href="#">Contact Us</a>
        </div>
        <p>
            © Copyright 2024 Opus Cinemas. All rights reserved. Co. Reg.
            No.: 194700158G
        </p>
    </footer>
    <script src="scripts/ticket_booking.js" async defer></script>
</body>
<script>
    new Splide('#cinemaSplide', {
        type: 'slide',
        perPage: 3,
        height: 100,
        gap: 10,
        pagination: false
    }).mount();

    new Splide('#timeSplide', {
        type: 'slide',
        perPage: 3,
        height: 100,
        gap: 10,
        pagination: false
    }).mount();
</script>

</html>