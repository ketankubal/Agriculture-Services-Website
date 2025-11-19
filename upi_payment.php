<?php
session_start();
include 'includes/db_connect.php';

// Check for order_id in URL
if (!isset($_GET['order_id'])) {
    header("Location: products.php");
    exit();
}
$order_id = $_GET['order_id'];

// Fetch order details
$query = "SELECT * FROM orders WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$result = $stmt->get_result();
$order = $result->fetch_assoc();

// Redirect if order doesn't exist
if (!$order) {
    header("Location: products.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>UPI Payment | AgriShop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Complete Your Payment</h2>
    <p>Scan the QR code or use the following UPI ID to complete the payment.</p>
    <img src="upi_qr_code.png" alt="UPI QR Code" class="img-fluid" width="200">
    <p><strong>UPI ID:</strong> shop@upi</p>

    <form action="verify_upi_payment.php" method="POST">
        <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
        <div class="mb-3">
            <label for="transaction_id" class="form-label">Enter UPI Transaction ID</label>
            <input type="text" class="form-control" name="transaction_id" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit Payment</button>
    </form>
</div>
</body>
</html>
