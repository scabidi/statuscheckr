<?php
session_start();

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if username and password are provided
    if (isset($_POST['username']) && isset($_POST['password'])) {
        // Validate username and password (You should implement proper validation and sanitation)
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Load user data from file
        $users_file = 'users.txt';
        if (file_exists($users_file)) {
            $users = unserialize(file_get_contents($users_file));

            // Check if username exists and password matches
            if (isset($users[$username]) && $users[$username] === $password) {
                // Authentication successful, set session variable
                $_SESSION['username'] = $username;
                // Redirect to dashboard
                header('Location: dashboard.php');
                exit();
            } else {
                // Invalid username or password
                echo "Invalid username or password.";
            }
        } else {
            echo "No users found.";
        }
    } else {
        echo "Please provide username and password.";
    }
}
?>
