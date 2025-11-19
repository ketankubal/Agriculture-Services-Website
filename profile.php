<?php
session_start();
include 'includes/db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// ✅ Fetch user details
$query = "SELECT username, email, phone FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

// ✅ Fetch user orders
$order_query = "
    SELECT o.order_id, p.name AS product_name, o.quantity, o.total_price, o.payment_status, o.order_date 
    FROM orders o 
    JOIN products p ON o.product_id = p.product_id 
    WHERE o.user_id = ?
    ORDER BY o.order_date DESC
";

$stmt = $conn->prepare($order_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$order_result = $stmt->get_result();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile & Orders</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .profile-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
        }
        .profile-header {
            background-color: #007bff;
            color: white;
            padding: 20px;
            border-radius: 10px 10px 0 0;
            text-align: center;
        }
        .table th {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>

<?php include 'includes/navbar.php'; ?>

<div class="container mt-5">
    <div class="profile-card">
        <div class="profile-header">
            <h2>👤 My Profile</h2>
        </div>
        <div class="mt-4">
            <table class="table table-bordered">
                <tr><th>Username</th><td><?php echo htmlspecialchars($user['username']); ?></td></tr>
                <tr><th>Email</th><td><?php echo htmlspecialchars($user['email']); ?></td></tr>
                <tr><th>Phone</th><td><?php echo htmlspecialchars($user['phone'] ?? 'Not provided'); ?></td></tr>
            </table>
        </div>
    </div>

    <!-- ✅ Order History Section -->
    <div class="profile-card mt-4">
        <div class="profile-header">
            <h2>📦 My Orders</h2>
        </div>
        <div class="mt-4">
            <?php if ($order_result->num_rows > 0): ?>
                <table class="table table-bordered mt-3">
                    <thead class="table-success">
                        <tr>
                            <th>Order ID</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Payment Status</th>
                            <th>Order Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $order_result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['order_id']; ?></td>
                                <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                                <td><?php echo $row['quantity']; ?></td>
                                <td>₹<?php echo number_format($row['total_price'], 2); ?></td>
                                <td><span class="badge bg-<?php echo $row['payment_status'] === 'Completed' ? 'success' : 'warning'; ?>">
                                    <?php echo $row['payment_status']; ?>
                                </span></td>
                                <td><?php echo date("d M Y, h:i A", strtotime($row['order_date'])); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-center text-muted">No orders found.</p>
            <?php endif; ?>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
