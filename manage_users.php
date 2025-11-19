<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit();
}

$users = $conn->query("SELECT * FROM users");

while ($user = $users->fetch_assoc()) {
    echo "User ID: " . $user['user_id'] . "<br>";
    echo "Username: " . $user['username'] . "<br>";
    echo "Email: " . $user['email'] . "<br>";
    // Add options to edit or delete the user
}
