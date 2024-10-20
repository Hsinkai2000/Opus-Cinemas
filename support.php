<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Opus | Support</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles/global.css" />
    <link rel="stylesheet" href="styles/support.css" />
</head>

<body>
    <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <header>
        <h3>Opus Cinemas</h3>
        <div>
            <ul class="nav">
                <li class="navlink">
                    <a href="home.php">Home</a>
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
        <div class="left-panel">
            <img src="assets/support_poster.png" alt="" />
        </div>
        <div class="right-panel">
            <h2>
                Need assistance? We're here to ensure your movie experience is flawless. Reach out, and let us handle
                the rest.
            </h2>
            <?php if (isset($_GET['error'])): ?>
                <div class="error-message" style="color: red;">
                    <?php echo htmlspecialchars($_GET['error']); ?>
                </div>
            <?php endif; ?>
            <form action="" method="post">
                <label for="name">Name</label>
                <input type="name" name="name" placeholder="Enter Name" required />
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Enter Email" required />
                <label for="question">Question</label>
                <textarea name="question" id="questionTF" rows="5" cols="60" placeholder="Enter Question"></textarea>
                <div class="actions">
                    <button type="submit" name="contactUs" id="contactUsButton" class="blue_button">
                        Contact Us!
                    </button>
                </div>
            </form>
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
    <script src="" async defer></script>
</body>

</html>