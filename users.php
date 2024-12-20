<?php
// Assuming you have a database connection file named database_connection.php
include 'database_connection.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the email and password from the POST request
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate email format on the server side
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: login.php?error=Invalid email format.");
        exit();
    }

    // You can choose what to do with the data: login or register
    if (isset($_POST['login'])) {
        // Handle login logic
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
        // Check if email already exists
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Email already exists
            header("Location: login.php?error=Email already exists.");
            exit();
        } else {
            // Handle registration logic
            $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $email, $password);
            
            if ($stmt->execute()) {
                // Registration successful, fetch the user ID and start session
                $_SESSION['user_id'] = $stmt->insert_id; // Get the ID of the inserted record
                $_SESSION['email'] = $email; // Store email for later use


                // Prepare the welcome email content
                $subject = 'Welcome to Opus Cinemas!';
                $message = "Dear $email,\n\n";
                $message .= "Welcome to Opus Cinemas! We are excited to have you as part of our community.\n\n";
                $message .= "Get ready to experience the magic of cinema, from the latest blockbusters to timeless classics. Keep an eye on our website for exclusive promotions and new movie releases.\n\n";
                $message .= "We hope you enjoy your journey with us and look forward to seeing you at the movies!\n\n";
                $message .= "Best Regards,\n";
                $message .= "Opus Cinemas Team";

                $headers = 'From: no-reply@opuscinemas.com' . "\r\n" .
                          'Reply-To: support@opuscinemas.com' . "\r\n" .
                          'X-Mailer: PHP/' . phpversion();

                // Send the email
                if (mail("irfansyakir@localhost", $subject, $message, $headers)) {
                    // Email sent successfully
                    echo "Registration successful. A welcome email has been sent to $email.";
                } else {
                    // Email failed to send
                    echo "Registration successful, but there was an error sending the welcome email.";
                }

                
                header("Location: home.php");
                exit();
            } else {
                echo "Error: " . $stmt->error; // Show error if registration fails
            }
        }
    }
}
?>
