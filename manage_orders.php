<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit();
}

$orders = $conn->query("SELECT * FROM orders");

while ($order = $orders->fetch_assoc()) {
    echo "Order ID: " . $order['order_id'] . "<br>";
    echo "User ID: " . $order['user_id'] . "<br>";
    echo "Total Amount: " . $order['total_amount'] . "<br>";
    echo "Order Date: " . $order['order_date'] . "<br>";
    // Add options to view or manage the order
}
