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

  // $stmt = $conn->prepare("INSERT INTO bookings (name, email) VALUES (?, ?)");
  $stmt = $conn->prepare("INSERT INTO bookings (user_id, movie_timing_id, price, name, email) VALUES (?,?,?,?,?)");
  $stmt->bind_param("sssss", $userId, $movieTimingId, $price, $name, $email);
  
  if ($stmt->execute()) {
    $booking_id = $conn->insert_id;

    foreach ($seats as $seat) {
      $stmt = $conn->prepare("INSERT INTO seats (booking_id, seat) VALUES (?,?)");
      $stmt->bind_param("ss",$booking_id, $seat);
      $stmt->execute();
    }
    
    header("Location: home.php?");
    exit();
  } else {
      echo "Error: " . $stmt->error;

  }
}
?>