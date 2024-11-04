<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.html');
    exit();
}

// Retrieve user's status from file
$status_file = 'user_statuses.txt';
$user_status = '';

if (file_exists($status_file)) {
    $user_statuses = unserialize(file_get_contents($status_file));
    $username = $_SESSION['username'];
    if (isset($user_statuses[$username])) {
        $user_status = $user_statuses[$username];
    }
}

// Update user's status
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['status'])) {
    $user_statuses[$username] = $_POST['status'];
    file_put_contents($status_file, serialize($user_statuses));
    $user_status = $_POST['status'];
}

// Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: login.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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

        h2 {
            text-align: center;
            color: #666;
        }

        form {
            text-align: center;
        }

        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            resize: vertical;
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

        a {
            display: block;
            text-align: center;
            text-decoration: none;
            color: #007bff;
            margin-top: 10px;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
         <a href="https://scabidi.com/statuscheckr"<h1>Status Checkr</h1></a>
        <h1>Welcome, <?php echo $_SESSION['username']; ?></h1>
        <h2>Your Status: <?php echo $user_status; ?></h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <textarea name="status" rows="4" cols="50" placeholder="Enter your status"><?php echo $user_status; ?></textarea><br>
            <button type="submit">Update Status</button>
        </form>
        <br>
        <a href="?logout=true">Logout</a>
    </div>
</body>
</html>
