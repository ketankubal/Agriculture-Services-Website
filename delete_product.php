<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
}

$id = $_GET['id'];

$conn = new mysqli('localhost', 'root', '', 'agriculture_service');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "DELETE FROM products WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Product deleted successfully!";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
