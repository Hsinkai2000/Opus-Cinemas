<?php
include 'database_connection.php';
session_start();

// Get the form data
$name = $_POST['name'];
$email = $_POST['email'];
$question = $_POST['question'];

// Prepare and execute the SQL statement
$stmt = $conn->prepare("INSERT INTO customer_support (name, email, question) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $question);

if ($stmt->execute()) {
    // Successful insertion
    echo "Your question has been submitted successfully!";
} else {
    // Error occurred
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();