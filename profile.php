<!-- profile.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Checkr - Followed</title>
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
    </style>
    <script>
        // Function to show popup message
        function showPopup(message) {
            alert(message);
        }

        // Check if URL contains 'added' query parameter
        var urlParams = new URLSearchParams(window.location.search);
        var added = urlParams.get('added');
        if (added === 'true') {
            showPopup('Followed successfully!');
        } else if (added === 'false') {
            showPopup('You are already following this user.');
        }
    </script>
</head>
<body>
    <div class="container">
        <a href="https://scabidi.com/statuscheckr"><h1 align="center">Status Checkr</h1></a>
        <h1>Welcome, <?php echo $username; ?></h1>
        <h2 align="center">Follow</h2>
        <form action="add_friend.php" method="post">
            <input type="text" name="friend" placeholder="Enter username">
            <button type="submit">Follow</button>
        </form>
    </div>
</body>
</html>
