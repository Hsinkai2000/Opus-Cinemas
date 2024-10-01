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
    <title>Opus | Cinemas</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="styles/global.css" />
    <link rel="stylesheet" href="styles/cinemas.css" />
</head>

<body>
    <header>
        <h3 class="opus-name">Opus Cinemas</h3>
        <div>
            <ul class="nav">
                <li class="navlink"><a href="home.php">Home</a></li>
                <li class="navlink">
                    <a class="active" href="cinemas.php">Cinemas</a>
                </li>
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
        <table>

            <?php
            $sql = "SELECT * FROM cinemas";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <tr>
                        <th rowspan="3">
                            <!-- defualt value is 2, i changed to 3 for debuging to fit in the movies -->
                            <img src="<?php echo $row["picture"]; ?>" alt="" />
                        </th>
                        <td>
                            <h3><?php echo $row["name"]; ?></h3>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>
                                <?php echo $row["description"]; ?>
                            </p>
                        </td>
                    </tr>

                    <!-- For this part, i put in the movies available at a cinema for debugging purposes-->
                    <tr>
                        <td>
                            <p>

                                <?php
                                $sql_movies = "SELECT m.title FROM cinemas_movies cm JOIN movies m ON cm.movie_id = m.movie_id WHERE cm.cinema_id = " . $row["cinema_id"];
                                $result_movies = $conn->query($sql_movies);

                                if ($result_movies && $result_movies->num_rows > 0) {
                                    echo "Movies Showing: <br>";
                                    while ($row_movies = $result_movies->fetch_assoc()) {
                                        echo $row_movies["title"] . "<br>"; // Add line break for better readability
                                    }
                                } else {
                                    echo "No movies found."; // Message if no movies are found
                                }
                                ?>
                            </p>
                        </td>
                    </tr>



            <?php
                }
            }
            ?>
        </table>
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
    <script src="" async defer></script>
</body>

</html>