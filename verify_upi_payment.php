<?php
session_start();
include 'includes/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $order_id = $_POST['order_id'];
    $transaction_id = $_POST['transaction_id'];

    // ✅ Store transaction ID and update order status
    $query = "UPDATE orders SET transaction_id = ?, status = 'Completed' WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $transaction_id, $order_id);
    $stmt->execute();

    header("Location: order_success.php?order_id=" . $order_id);
    exit();
} else {
    header("Location: products.php");
    exit();
}
?>
