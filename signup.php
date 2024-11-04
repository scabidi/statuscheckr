<?php
// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if all fields are provided
    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {
        // Validate username and password (You should implement proper validation and sanitation)
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        // Check if passwords match
        if ($password !== $confirm_password) {
            echo "Passwords do not match.";
            exit();
        }

        // Load existing user data from file
        $users_file = 'users.txt';
        $users = [];
        if (file_exists($users_file)) {
            $users = unserialize(file_get_contents($users_file));
        }

        // Check if username already exists
        if (isset($users[$username])) {
            echo "Username already exists. Please choose a different one.";
            exit();
        }

        // Add new user
        $users[$username] = $password;

        // Save updated user data to file
        file_put_contents($users_file, serialize($users));

        echo "Signup successful. You can now <a href='login.html'>login</a>.";
    } else {
        echo "Please provide all required fields.";
    }
}
?>
