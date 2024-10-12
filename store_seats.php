<?php
session_start(); // Start the session

// Get the input data
$input = json_decode(file_get_contents('php://input'), true);

if (isset($input['seats'])) {
    $_SESSION['selected_seats'] = $input['seats'];
    $_SESSION['cinema_id'] = $input['cinema_id'];
    $_SESSION['movie_id'] = $input['movie_id'];
    $_SESSION['timing'] = $input['timing'];
}
