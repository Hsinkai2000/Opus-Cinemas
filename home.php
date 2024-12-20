<?php
include 'database_connection.php';
session_start();


?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Opus | Home</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="styles/global.css?v=1" />
    <link rel="stylesheet" href="styles/home.css" />
    <link href="https://fonts.googleapis.com/css2?family=Chivo:wght@400;700&display=swap" rel="stylesheet">

</head>

<body>
    <!--[if lt IE 7]>
            <p class="browsehappy">
                You are using an <strong>outdated</strong> browser. Please
                <a href="#">upgrade your browser</a> to improve your experience.
            </p>
        <![endif]-->
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
        <div>
            <img src="assets/avatarsplash_screen.png" alt="" id="splash_screen" />
        </div>
        <div class="section">
            <hr />
            <div class="section-heading">
                <h3>Now Showing</h3>
                <a href="now_showing.php">View All</a>
            </div>

            <div class="card-list">

                <?php
                $sql = "SELECT id,title, description, picture, director, writers, actors FROM movies WHERE isUpcoming = false ";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="card" onclick=<?php echo "movieclicked(" . $row['id'] . ")" ?>>
                            <img class="card-image" src="<?php echo $row["picture"]; ?>" alt="" />
                            <span><?php echo $row["title"]; ?></span>
                        </div>

                <?php
                    }
                }
                ?>


            </div>
        </div>

        <div class="section">
            <hr />
            <div class="section-heading">
                <h3>Upcoming</h3>
            </div>

            <div class="card-list">
                <?php
                $sql = "SELECT id,title, description, picture, director, writers, actors FROM movies WHERE isUpcoming = true ";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="card" onclick=<?php echo "movieclicked(" . $row['id'] . ")" ?>>
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
    <script src="scripts/home.js" async defer></script>
</body>

</html>