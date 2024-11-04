<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.html"); // Redirect to login page if not logged in
    exit();
}

// Function to add a friend
function addFriend($username, $friend) {
    $followers_file = 'followers.txt';

    // Load existing followers data
    $followers_data = [];
    if (file_exists($followers_file)) {
        $followers_data = unserialize(file_get_contents($followers_file));
    }

    // Check if the friend already exists in the list
    if (!isset($followers_data[$username])) {
        $followers_data[$username] = [];
    } else {
        if (in_array($friend, $followers_data[$username])) {
            // Friend already exists, so don't add again
            return false;
        }
    }

    // Add friend to user's followers
    $followers_data[$username][] = $friend;

    // Save updated followers data
    file_put_contents($followers_file, serialize($followers_data));

    return true;
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['friend'])) {
    $username = $_SESSION['username'];
    $friend = $_POST['friend'];

    // Add friend if not already added
    if (addFriend($username, $friend)) {
        // Friend added successfully
        header("Location: profile.php?added=true");
        exit();
    } else {
        // Friend already exists
        header("Location: profile.php?added=false");
        exit();
    }
}
?>
