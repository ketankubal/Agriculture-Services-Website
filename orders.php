<?php
session_start();
include __DIR__ . '/includes/db_connect.php'; // Ensure the correct database connection

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Error: User is not logged in.");
}

$user_id = $_SESSION['user_id']; // Get logged-in user ID

// Ensure database connection is successful
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Fetch user orders with product details
$query = "
    SELECT orders.id AS order_id, orders.total_amount, orders.created_at, orders.status,
           order_items.quantity, order_items.total_price,
           products.name AS product_name, products.image AS product_image,
           users.name AS customer_name
    FROM orders
    INNER JOIN order_items ON orders.id = order_items.order_id
    INNER JOIN products ON order_items.product_id = products.id
    INNER JOIN users ON orders.user_id = users.id
    WHERE orders.user_id = $user_id
    ORDER BY orders.id DESC
";

$result = mysqli_query($conn, $query);

// Check if query execution was successful
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .order-card {
            border-radius: 10px;
            transition: 0.3s;
        }
        .order-card:hover {
            transform: scale(1.02);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        .order-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">📦 My Orders</h2>

    <?php if (mysqli_num_rows($result) > 0): ?>
        <div class="row">
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="col-md-6 mb-4">
                    <div class="card order-card p-3">
                        <div class="d-flex align-items-center">
                            <img src="uploads/<?php echo htmlspecialchars($row['product_image'] ?: 'default.jpg'); ?>" class="order-img me-3" alt="Product Image">
                            <div>
                                <h5><?php echo htmlspecialchars($row['product_name']); ?></h5>
                                <p>Customer: <strong><?php echo htmlspecialchars($row['customer_name']); ?></strong></p>
                                <p>Quantity: <strong><?php echo $row['quantity']; ?></strong></p>
                                <p>Total: <strong>$<?php echo $row['total_price']; ?></strong></p>
                                <p>Status: <span class="badge bg-info"><?php echo htmlspecialchars($row['status']); ?></span></p>
                                <p><small>Ordered on: <?php echo $row['created_at']; ?></small></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p class="text-center">No orders found.</p>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
