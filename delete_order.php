<?php
include '../includes/db_connect.php';

if (isset($_GET['order_id']) && is_numeric($_GET['order_id'])) {
    $order_id = intval($_GET['order_id']); // ✅ Secure integer conversion
    
    // ✅ Use correct column name 'id' instead of 'order_id'
    $query = "DELETE FROM orders WHERE id='$order_id'";

    if (mysqli_query($conn, $query)) {
        header("Location: admin_orders.php?message=Order Deleted");
        exit();
    } else {
        die("Error deleting order: " . mysqli_error($conn));
    }
} else {
    header("Location: admin_orders.php?message=No Order Selected");
    exit();
}
?>
