<?php
// login.php

// Database connection
$host = 'localhost'; // or your database host
$db = 'opus_cinemas'; // your database name
$user = 'root'; // your database user
$pass = ''; // your database password

session_start(); // Start a session

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Prepare the SQL statement
        $stmt = $pdo->prepare("SELECT id, password FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Check if the user exists
        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verify the password
            if (password_verify($password, $user['password'])) {
                $testPass = $user['password']
                // Password is correct, log the user in
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $email;
                echo "Login successful!";
                // Redirect to a protected page (e.g., home.php)
                header("Location: home.php");
                exit();
            } else {
                echo "Invalid password: $password.";
                #echo "<br> password is $testPass";
            }
        } else {
            echo "No user found with that email.";
        }
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>