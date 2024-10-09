<?php
// Assuming you have a database connection file named database_connection.php
include 'database_connection.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the email and password from the POST request
    $email = $_POST['email'];
    $password = $_POST['password'];

    // You can choose what to do with the data: login or register
    if (isset($_POST['login'])) {
        // Handle login logic
        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
        $stmt->bind_param("ss", $email, $password); // "ss" means both parameters are strings
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // User found, login successful
            $user = $result->fetch_assoc();
            
            // Store user information in session
            $_SESSION['user_id'] = $user['id']; // Assuming your users table has an 'id' column
            $_SESSION['email'] = $user['email']; // Store email for later use
            
            header("Location: home.php?success=true");
            exit();
        } else {
            // Invalid credentials
            header("Location: login.php?error=Invalid email or password.");
            exit();
        }
    } elseif (isset($_POST['register'])) {
        // Handle registration logic
        // Use prepared statements for registration as well
        $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $password);
        
        if ($stmt->execute()) {
            // Registration successful, fetch the user ID and start session
            $_SESSION['user_id'] = $stmt->insert_id; // Get the ID of the inserted record
            $_SESSION['email'] = $email; // Store email for later use
            
            header("Location: home.php");
            exit();
        } else {
            echo "Error: " . $stmt->error; // Show error if registration fails
        }
    }
}
?>