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

        <link rel="stylesheet" href="styles/global.css" />
        <link rel="stylesheet" href="styles/home.css" />
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
                    <li class="navlink"><a href="cinemas.html">Cinemas</a></li>
                    <li class="navlink"><a href="#">Now Showing</a></li>
                </ul>
            </div>
            <a class="navlink login" href="login.html">Login</a>
        </header>

        <div class="wrapper">
            <div>
                <img
                    src="assets/avatarsplash_screen.png"
                    alt=""
                    id="splash_screen"
                />
            </div>
            <div class="section">
                <hr />
                <div class="section-heading">
                    <h3>Now Showing</h3>
                    <a href="$">View All</a>
                </div>

                <div class="card-list">
                    <div class="card">
                        <img
                            src="assets/covers/avatar_the_last_airbender_cover.png"
                            alt=""
                        />
                        <span>Avatar: The Last Airbendeer</span>
                    </div>

                    <div class="card">
                        <img src="assets/covers/aquaman_cover.png" alt="" />
                        <span>Aquaman</span>
                    </div>

                    <div class="card">
                        <img
                            src="assets/covers/deadpool_x_wolverine_cover.png"
                            alt=""
                        />
                        <span>Deadpool x Wolverine</span>
                    </div>

                    <div class="card">
                        <img src="assets/covers/quantumania_cover.png" alt="" />
                        <span>Quantumania</span>
                    </div>
                    <div class="card">
                        <img src="assets/covers/garfield_cover.png" alt="" />
                        <span>Garfield: The Movie</span>
                    </div>
                    <div class="card">
                        <img
                            src="assets/covers/fistful_scavengers_cover.png"
                            alt=""
                        />
                        <span>Fistful Scavengers</span>
                    </div>
                    <div class="card">
                        <img
                            src="assets/covers/little_mermaid_cover.png"
                            alt=""
                        />
                        <span>Little Mermaid</span>
                    </div>
                    <div class="card">
                        <img src="assets/covers/dynasty_cover.png" alt="" />
                        <span>Dynasty</span>
                    </div>
                    <div class="card">
                        <img
                            src="assets/covers/avatar_the_lost_ark_cover.png"
                            alt=""
                        />
                        <span>Avatar: The Lost Ark</span>
                    </div>
                    <div class="card">
                        <img src="assets/covers/up_cover.png" alt="" />
                        <span>Up!</span>
                    </div>
                </div>
            </div>
            <div class="section">
                <hr />
                <div class="section-heading">
                    <h3>Upcoming</h3>
                    <a href="$">View All</a>
                </div>

                <div class="card-list">
                    <div class="card">
                        <img src="assets/covers/fighter_cover.png" alt="" />
                        <span>Fighter</span>
                    </div>

                    <div class="card">
                        <img src="assets/covers/symphony_cover.png" alt="" />
                        <span>Symphony</span>
                    </div>

                    <div class="card">
                        <img
                            src="assets/covers/inside_out_2_cover.png"
                            alt=""
                        />
                        <span>Inside Out 2</span>
                    </div>

                    <div class="card">
                        <img src="assets/covers/wonka_cover.png" alt="" />
                        <span>Wonka</span>
                    </div>
                    <div class="card">
                        <img src="assets/covers/the_creator_cover.png" alt="" />
                        <span>The Creator</span>
                    </div>
                </div>
            </div>

            <div class="section">
                <hr />
                <div class="section-heading">
                    <h3>UTeeeffst</h3>
                </div>
                <?php
                  // MySQL server connection details
                  $servername = "localhost"; // Your SQL server's hostname
                  $username = "root"; // Your SQL server's username
                  $password = ""; // Your SQL server's password
                  $dbname = "opus_cinemas"; // Your database name

                  // Create connection
                  $conn = new mysqli($servername, $username, $password, $dbname);

                  // Check connection
                  if ($conn->connect_error) {
                      die("Connection failed: " . $conn->connect_error);
                  }

                  // SQL query to select all movies from the movies table
                  $sql = "SELECT title, genre, description, picture, director, writers, actors FROM movies";
                  $result = $conn->query($sql);

                  if ($result->num_rows > 0) {
                      // Output data for each row
                      echo "<div class='movies-list'>";
                      while($row = $result->fetch_assoc()) {
                          echo "<div class='movie'>";
                          echo "<h3>" . $row["title"] . "</h3>"; // Echo movie title
                          echo "<p><strong>Genre:</strong> " . $row["genre"] . "</p>";
                          echo "<p><strong>Description:</strong> " . $row["description"] . "</p>";
                          echo "<p><strong>Director:</strong> " . $row["director"] . "</p>";
                          echo "<p><strong>Writers:</strong> " . $row["writers"] . "</p>";
                          echo "<p><strong>Actors:</strong> " . $row["actors"] . "</p>";
                          echo "<img src='" . $row["picture"] . "' alt='" . $row["title"] . "' style='width: 150px; height: 200px;'/>";
                          echo "</div><hr>";
                      }
                      echo "</div>";
                  } else {
                      echo "No movies found.";
                  }

                  // Close connection
                  $conn->close();
                ?>
                
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
        <script src="" async defer></script>
    </body>
</html>
