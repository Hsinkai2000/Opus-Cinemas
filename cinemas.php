<?php
  include 'database_connection.php'
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
                    <li class="navlink"><a href="#">Now Showing</a></li>
                </ul>
            </div>
            <a class="navlink login" href="login.html">Login</a>
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
                    <th rowspan="2">
                        <img src="<?php echo $row["picture"];?>" alt="" />
                    </th>
                    <td><h3><?php echo $row["name"]; ?></h3></td>
                </tr>
                <tr>
                    <td>
                        <p>
                            <?php echo $row["description"]; ?>
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
