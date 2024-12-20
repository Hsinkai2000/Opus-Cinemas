<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>

  <head>
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <title>Login</title>
      <meta name="description" content="" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <link rel="stylesheet" href="styles/global.css" />
      <link rel="stylesheet" href="styles/login.css" />
  </head>

  <body>
    <header>
      <h3>Opus Cinemas</h3>
      <div>
        <ul class="nav">
          <li class="navlink"><a href="home.php">Home</a></li>
          <li class="navlink"><a href="cinemas.php">Cinemas</a></li>
          <li class="navlink"><a href="now_showing.php">Now Showing</a></li>
        </ul>
      </div>
      <a class="navlink login active" href="login.php">Login</a>
    </header>

    <div class="wrapper">
      <div class="left-panel">
          <img src="assets/image.png" alt="" />
      </div>

      <div class="right-panel">
        <h2>
          Unlock the door to cinematic extravagance. <br />Log in to
          your exclusive movie haven.
        </h2>
          <?php if (isset($_GET['error'])): ?>
            <div class="error-message" style="color: red;">
              <?php echo htmlspecialchars($_GET['error']); ?>
            </div>
          <?php endif; ?>
          <form action="users.php" method="post" onsubmit="return validateEmail()">
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="Enter Email" required />
            <label for="password">Password</label>
            <input type="password" placeholder="Enter Password" name="password" required />

            <div class="actions">
              <button type="submit" name="login" id="loginButton" class="blue_button">
                Login
              </button>
              <button type="submit" name="register" id="registerButton" class="transparent_button">
                Register
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
    <script src="scripts/login.js" async defer></script>
    <script>
      function validateEmail() {
        const emailField = document.querySelector('input[name="email"]');
        const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (!emailPattern.test(emailField.value)) {
          alert('Please enter a valid email address in the format xxx@yyy.com');
          emailField.focus();
          return false;
        }
        return true;
      }
    </script>
    </script>
  </body>
</html>