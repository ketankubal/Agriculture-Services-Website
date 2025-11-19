<?php
session_start();
include '../includes/db_connect.php'; // Ensure this path is correct

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

// Check if user_id is provided
if (!isset($_GET['user_id']) || empty($_GET['user_id'])) {
    die("❌ Error: User ID is missing!");
}

$user_id = intval($_GET['user_id']); // Sanitize input

// Prepare and execute delete query
$query = "DELETE FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
if (!$stmt) {
    die("❌ SQL Prepare Error: " . $conn->error);
}
$stmt->bind_param("i", $user_id);

if ($stmt->execute()) {
    $_SESSION['message'] = "✅ User deleted successfully!";
} else {
    $_SESSION['error'] = "❌ Failed to delete user!";
}

$stmt->close();
$conn->close();

// Redirect back to manage users page
header("Location: manage_users.php");
exit;
