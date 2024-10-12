<?php
include 'database_connection.php';

// Get the parameters from the client (cinema_id, movie_id, timing)
$cinema_id = $_GET['cinema_id'];
$movie_id = $_GET['movie_id'];
$timing = $_GET['timing'];


// Prepare and execute the query
$stmt = $conn->prepare("SELECT s.seat 
    FROM seats s
    INNER JOIN bookings b ON s.booking_id = b.id
    INNER JOIN movie_timings mt ON b.movie_timing_id = mt.id
    WHERE mt.cinema_id = ?
    AND mt.movie_id = ?
    AND mt.timing = ?");
$stmt->bind_param('iis', $cinema_id, $movie_id, $timing);

$stmt->execute();
$takenSeatsResult = $stmt->get_result();

$takeSeats = [];

while ($row = $takenSeatsResult->fetch_assoc()) {
    $takenSeats[] = $row['seat'];
}

$stmt->close();

// Return the seats as a JSON response
header('Content-Type: application/json');
if (empty($takenSeats)) {
    echo json_encode([]);
} else {
    echo json_encode($takenSeats);
}
