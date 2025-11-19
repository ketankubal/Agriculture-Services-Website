<?php
session_start();
include 'includes/db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'])) {
    $order_id = intval($_POST['order_id']);
    $user_id = $_SESSION['user_id'];

    // ✅ Check if the order belongs to the user and is still processing
    $query = "SELECT id FROM orders WHERE id = ? AND user_id = ? AND order_status = 'Processing'";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $order_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        // ✅ Update order status to "Cancelled"
        $update_query = "UPDATE orders SET order_status = 'Cancelled' WHERE id = ?";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bind_param("i", $order_id);
        $update_stmt->execute();

        // ✅ Redirect to my_orders.php with a success message
        $_SESSION['message'] = "Order #$order_id has been cancelled successfully!";
        header("Location: my_orders.php");
        exit();
    } else {
        // ✅ If the order doesn't exist or is already processed
        $_SESSION['error'] = "Order cannot be cancelled.";
        header("Location: my_orders.php");
        exit();
    }
} else {
    header("Location: my_orders.php");
    exit();
}
?>
