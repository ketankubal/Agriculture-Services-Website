<?php
// Start session to track login status
session_start();

// Check if user is logged in, otherwise redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>

    <h1>Welcome to the Home Page</h1>
    <p>You are successfully logged in.</p>

    <a href="logout.php">Logout</a> <!-- Add a logout link -->

</body>
</html>
