<?php
session_start();
include '../includes/db_connect.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input values
    if (isset($_POST['order_id']) && isset($_POST['status'])) {
        $order_id = $_POST['order_id'];
        $status = $_POST['status'];

        // Prepare the SQL statement
        $query = "UPDATE orders SET order_status = ? WHERE id = ?"; 
        $stmt = $conn->prepare($query);

        if ($stmt) {
            // Bind parameters and execute the statement
            $stmt->bind_param("si", $status, $order_id);
            if ($stmt->execute()) {
                $_SESSION['message'] = "✅ Order status updated successfully!";
            } else {
                $_SESSION['message'] = "❌ Error updating order status: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $_SESSION['message'] = "❌ SQL Error: " . $conn->error;
        }
    } else {
        $_SESSION['message'] = "❌ Invalid request!";
    }
}

// Redirect back to manage orders page
header("Location: manage_orders.php");
exit();
?>
