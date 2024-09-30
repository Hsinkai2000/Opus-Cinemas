<?php
// Assuming you have a database connection file named db.php
include 'database_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the email and password from the POST request
    $email = $_POST['email'];
    $password = $_POST['password'];

    // You can choose what to do with the data: login or register
    if (isset($_POST['login'])) {
        // Handle login logic
        // Example: Validate user credentials against the database
        // (This is just a basic example; you should use prepared statements to prevent SQL injection)
        
        $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            // User found, login successful
            header("Location: home.php");
            exit();
            
        } else {
            // Invalid credentials
            echo "Invalid email or password. email is: $email";
        }
    } elseif (isset($_POST['register'])) {
        // Handle registration logic
        // Example: Insert new user into the database
        $query = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
        if (mysqli_query($conn, $query)) {
            echo "Registration successful!";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>
