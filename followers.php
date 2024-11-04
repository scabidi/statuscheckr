<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.html"); // Redirect to login page if not logged in
    exit();
}

$username = $_SESSION['username'];

// Function to retrieve user's followers and their statuses
function getUserFollowersWithStatus($username) {
    $followers_file = 'followers.txt';
    $status_file = 'user_statuses.txt';

    // Load followers data
    $followers_data = [];
    if (file_exists($followers_file)) {
        $followers_data = unserialize(file_get_contents($followers_file));
    }

    // Load statuses data
    $statuses_data = [];
    if (file_exists($status_file)) {
        $statuses_data = unserialize(file_get_contents($status_file));
    }

    // Initialize an array to store followers with their statuses
    $followers_with_status = [];

    // Check if the user has any followers
    if (isset($followers_data[$username])) {
        foreach ($followers_data[$username] as $follower) {
            // Check if the follower's status exists
            $status = isset($statuses_data[$follower]) ? $statuses_data[$follower] : 'No status available';
            // Add follower with status to the array
            $followers_with_status[$follower] = $status;
        }
    }

    // Return followers with their statuses
    return $followers_with_status;
}

// Get user's followers with their statuses
$user_followers_with_status = getUserFollowersWithStatus($username);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Followers</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin-bottom: 10px;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 5px;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <a href="https://scabidi.com/statuscheckr"><h1 align="center">Scabidi - Status Checkr</h1></a>
    <h1>People You Follow</h1>
    <?php if (!empty($user_followers_with_status)) : ?>
        <ul>
            <?php foreach ($user_followers_with_status as $follower => $status) : ?>
                <li>
                    <strong><?php echo $follower; ?>:</strong> <?php echo $status; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p>You are not following anyone yet.</p>
    <?php endif; ?>
    <a href="profile.php">Go back to profile</a>
</body>
</html>
