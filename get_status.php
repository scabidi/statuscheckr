<?php
// Load user statuses from file
$status_file = 'user_statuses.txt';
$user_statuses = [];

if (file_exists($status_file)) {
    $user_statuses = unserialize(file_get_contents($status_file));
}

// Check if username exists
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['username'])) {
    $username = $_GET['username'];
    if (isset($user_statuses[$username])) {
        echo json_encode(array("status" => $user_statuses[$username]));
    } else {
        echo json_encode(array("status" => "User not found"));
    }
}
?>
