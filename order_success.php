<?php
session_start();
include 'includes/db_connect.php';

// Debugging: Check if order_id is received
if (!isset($_GET['order_id'])) {
    die("❌ Missing Order ID in the URL. Please contact support.");
}

$order_id = $_GET['order_id'];

// Debugging: Print the order ID to check if it's received properly
echo "Order ID received: " . $order_id;

$query = "SELECT * FROM orders WHERE order_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $order = $result->fetch_assoc();
    ?>
    <div class="container mt-5 text-center">
        <h2 class="text-success">Order Successful! 🎉</h2>
        <p>Thank you for your purchase, <?php echo htmlspecialchars($order['full_name']); ?>!</p>
        <p>Your order ID is: <strong>#<?php echo $order['order_id']; ?></strong></p>
        <p>Total Amount: ₹<?php echo number_format($order['total_amount'], 2); ?></p>
        <p>Status: Order Placed</p>
        <p>We will contact you shortly for delivery details.</p>
        <a href="products.php" class="btn btn-primary mt-3">🛍 Continue Shopping</a>
    </div>
    <?php
} else {
    echo "❌ Order not found. Please contact support.";
}

$stmt->close();
$conn->close();
?>
