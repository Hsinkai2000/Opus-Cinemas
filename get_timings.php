<?php
include 'database_connection.php';
$movie_id = $_POST['movie_id'];
$cinema_id = $_POST['cinema_id']; // This comes from the selected cinema

$movie_timing_stmt = $conn->prepare("SELECT * FROM movie_timings WHERE movie_id = ? AND cinema_id = ?");
$movie_timing_stmt->bind_param("ii", $movie_id, $cinema_id);

$movie_timing_stmt->execute();
$timing_result = $movie_timing_stmt->get_result();

// Prepare the response as an array of timings
$timings = [];
while ($row = $timing_result->fetch_assoc()) {
    $timings[] = $row['timing']; // Assuming 'timing' is the column name
}

$movie_timing_stmt->close();

// Send JSON response back to the client
header('Content-Type: application/json');
echo json_encode(['timings' => $timings]);
