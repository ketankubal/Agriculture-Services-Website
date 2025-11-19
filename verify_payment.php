<?php
include '../includes/db_connect.php';

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    
    // Update order status
    $query = "UPDATE orders SET order_status='Confirmed' WHERE order_id='$order_id'";
    
    if (mysqli_query($conn, $query)) {
        header("Location: admin_orders.php?message=Order Verified");
    } else {
        die("Error updating order: " . mysqli_error($conn));
    }
} else {
    header("Location: admin_orders.php?message=No Order Selected");
}
?>
