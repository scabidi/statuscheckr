<?php
// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['username'])) {
    // Validate username (You should implement proper validation and sanitation)
    $username = $_GET['username'];

    // Load user statuses from file
    $status_file = 'user_statuses.txt';
    $user_statuses = [];

    if (file_exists($status_file)) {
        $user_statuses = unserialize(file_get_contents($status_file));
    }

    // Check if username exists
    if (isset($user_statuses[$username])) {
        echo "Status for $username: " . $user_statuses[$username];
    } else {
        echo "User not found.";
    }
} else {
    echo "Please provide a username to search.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Checkr</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
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
            color: #333;
        }

        form {
            text-align: center;
        }

        input[type="text"] {
            width: 70%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        p {
            text-align: center;
            margin-top: 20px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="https://scabidi.com/statuscheckr"><h1>Status Checkr</h1></a>
        <form action="search.php" method="GET">
            <input type="text" name="username" placeholder="Search Username">
            <button type="submit">Search</button>
        </form>
        <?php
        // Display search result
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['username'])) {
            echo "<p>";
            if (isset($user_statuses[$username])) {
                echo "Status for $username: " . $user_statuses[$username];
            } else {
                echo "User not found.";
            }
            echo "</p>";
        }
        ?>
    </div>
</body>
</html>
