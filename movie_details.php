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

$genre_stmt = $conn->prepare("SELECT genre FROM genres WHERE movie_id =?");
$genre_stmt->bind_param("i", $movie_id);

$genre_stmt->execute();
$genre_list = $genre_stmt->get_result();

$genre_stmt->close();
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
    <link rel="stylesheet" href="styles/global.css">
    <link rel="stylesheet" href="styles/movie_details.css">
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
            <a class="navlink login" href="account.php"><?php echo htmlspecialchars($_SESSION['email']); ?></a>
        <?php } ?>
    </header>

    <div class="wrapper">

        <div class="movie_details">
            <img class="movie-image" src="<?php echo $movie['picture'] ?>" alt="<?php echo $movie['title'] ?>">
            <div class="movie-meta">
                <h2><?php echo $movie['title'] ?></h2>
                <div class="genre_section">
                    <?php while ($row = $genre_list->fetch_assoc()) { ?>
                        <div>
                            <div class="genre_bubble"><?php echo $row["genre"]; ?></div>
                        </div>

                    <?php } ?>
                </div>
                <p><?php echo $movie['description'] ?></p>
                <div class="button_group">
                    <button class="transparent_button">Watch Trailer</button>
                    <button class="blue_button" onclick="bookNowClicked(<?php echo $movie_id ?>)">Book Now</button>
                </div>
            </div>
            <div class="movie-cast">
                <hr>
                <div class="cast-details">
                    <h4>Director</h4>
                    <span>
                        <?php echo $movie['director'] ?>
                    </span>
                </div>
                <hr>

                <div class="cast-details">
                    <h4>Writers</h4>
                    <span>
                        <?php echo $movie['writers'] ?>
                    </span>
                </div>

                <hr>
                <div class="cast-details">
                    <h4>Actors</h4>
                    <span>
                        <?php echo $movie['actors'] ?>
                    </span>
                </div>
            </div>
        </div>


        <div class="section">
            <hr />
            <div class="section-heading">
                <h3>Similar Movies</h3>
                <a href="now_showing.php">View All</a>
            </div>

            <div class="card-list">

                <?php
                $sql = "SELECT id,title, description, picture, director, writers, actors FROM movies WHERE isUpcoming = false ";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="card" onclick=<?php echo "testFunction(" . $row['id'] . ")" ?>>
                            <img class='card-image' src="<?php echo $row["picture"]; ?>" alt="" />
                            <span><?php echo $row["title"]; ?></span>
                        </div>

                <?php
                    }
                }
                ?>


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
    <script src="scripts/movie_details.js" async defer></script>
</body>

</html>