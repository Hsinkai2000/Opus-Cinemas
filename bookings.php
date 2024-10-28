<?php
// Assuming you have a database connection file named database_connection.php
include 'database_connection.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $movieTimingId = $_POST['movie_timing_id'];
    $price = $_POST["price"];
    $userId = $_POST["userId"];
    $seats = unserialize($_POST["seats"]);
    $cardNumber = $_POST['card-number'];

    // Get the last 4 digits of the card number
    $cardLast4 = substr($cardNumber, -4);

    // Insert booking details into the bookings table
    $stmt = $conn->prepare("INSERT INTO bookings (user_id, movie_timing_id, price, name, email) VALUES (?,?,?,?,?)");
    $stmt->bind_param("iidss", $userId, $movieTimingId, $price, $name, $email);

    if ($stmt->execute()) {
        $booking_id = $conn->insert_id;

        // Insert each seat into the seats table
        foreach ($seats as $seat) {
            $stmt = $conn->prepare("INSERT INTO seats (booking_id, seat) VALUES (?,?)");
            $stmt->bind_param("is", $booking_id, $seat);
            $stmt->execute();
        }

        // Prepare the email content
        $title = isset($_POST['title']) ? $_POST['title'] : "Unknown Movie";
        $cinema = isset($_POST['cinema']) ? $_POST['cinema'] : "Unknown Cinema";
        $timing = isset($_POST['timing']) ? $_POST['timing'] : "Unknown Time";

        $to = $email;
        $subject = 'Booking Confirmation - Opus Cinemas';
        $message = "Dear $name,\n\n";
        $message .= "Thank you for booking with Opus Cinemas. Here are your booking details:\n\n";
        $message .= "Movie: " . $title . "\n";
        $message .= "Cinema: " . $cinema . "\n";
        $message .= "Time Slot: " . $timing . "\n";
        $message .= "Seats: " . implode(", ", $seats) . "\n";
        $message .= "Total Amount Paid: $" . number_format($price, 2) . "\n";
        $message .= "Card Used: **** **** **** " . $cardLast4 . "\n\n";
        $message .= "We hope you enjoy the movie!\n\n";
        $message .= "Regards,\n";
        $message .= "Opus Cinemas";

        $headers = 'From: no-reply@opuscinemas.com' . "\r\n" .
                   'Reply-To: support@opuscinemas.com' . "\r\n" .
                   'X-Mailer: PHP/' . phpversion();

        // Send the email
        if (mail("irfansyakir@localhost", $subject, $message, $headers)) {
            // Email sent successfully, redirect to account.php
            header("Location: account.php");
            exit();
        } else {
            // Email failed to send
            echo "Booking saved, but there was an error sending your confirmation email.";
        }
    } else {
        // SQL error
        echo "Error: " . $stmt->error;
    }
}
?>
