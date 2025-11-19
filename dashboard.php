<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page
    exit();
}

include __DIR__ . '/includes/db_connect.php'; // Ensure correct DB connection
$user_id = $_SESSION['user_id'];

// Fetch user details (Optional)
$query = "SELECT name FROM users WHERE id = $user_id";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);
$username = $user['name'] ?? 'User';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Agriculture eCommerce</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .dashboard-card {
            transition: 0.3s;
            border-radius: 10px;
            text-align: center;
        }
        .dashboard-card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        .card-icon {
            font-size: 40px;
            color: #007bff;
        }
        .logout-btn {
            position: absolute;
            top: 15px;
            right: 20px;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">👋 Welcome, <?php echo htmlspecialchars($username); ?>!</h2>

    <a href="logout.php" class="btn btn-danger logout-btn">Logout</a>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card dashboard-card p-3">
                <span class="card-icon">🛍️</span>
                <h5>Shop Products</h5>
                <a href="products.php" class="btn btn-primary">View Products</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card dashboard-card p-3">
                <span class="card-icon">📦</span>
                <h5>My Orders</h5>
                <a href="orders.php" class="btn btn-success">📦 View My Orders</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card dashboard-card p-3">
                <span class="card-icon">🛒</span>
                <h5>My Cart</h5>
                <a href="cart.php" class="btn btn-warning">🛒 View Cart</a>
            </div>
        </div>
    </div>

    <!-- ADDITIONAL "VIEW ORDERS" BUTTON -->
    <div class="text-center mt-4">
        <a href="orders.php" class="btn btn-primary btn-lg">📦 View My Orders</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
