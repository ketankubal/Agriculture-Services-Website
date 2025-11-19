<?php  
session_start();
include '../includes/db_connect.php'; // Ensure this path is correct

// Check if the user is logged in as admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

// Check if order_id is provided
if (!isset($_GET['order_id']) || empty($_GET['order_id'])) {
    die("<div class='alert alert-danger text-center mt-5'>❌ Error: Order ID is missing!</div>");
}

$order_id = intval($_GET['order_id']); // Sanitize input

// Fetch order details
$query = "
    SELECT o.id AS order_id, u.username, o.address, o.total_price, o.order_status, o.order_date
    FROM orders o 
    JOIN users u ON o.user_id = u.id 
    WHERE o.id = ?
";

$stmt = $conn->prepare($query);
if (!$stmt) {
    die("<div class='alert alert-danger text-center mt-5'>❌ SQL Prepare Error (Order Details): " . $conn->error . "</div>");
}

$stmt->bind_param("i", $order_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("<div class='alert alert-warning text-center mt-5'>⚠ No order found with ID $order_id</div>");
}

$order = $result->fetch_assoc();
$stmt->close();

// 🎨 Order Status Badge Styling
$status_badge = [
    "Pending" => "badge bg-warning text-dark",
    "Processing" => "badge bg-info",
    "Shipped" => "badge bg-primary",
    "Delivered" => "badge bg-success",
    "Cancelled" => "badge bg-danger"
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Order | Admin Panel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body {
            background: #f8f9fa;
        }
        .order-container {
            max-width: 800px;
            margin: auto;
            margin-top: 50px;
            padding: 30px;
            background: white;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .order-header {
            text-align: center;
            color: #007bff;
            font-weight: bold;
        }
        .order-table {
            font-size: 16px;
        }
        .back-btn {
            width: 100%;
        }
    </style>
</head>
<body>

<div class="order-container">
    <h2 class="order-header"><i class="fas fa-receipt"></i> Order Details</h2>
    <hr>

    <table class="table table-bordered table-hover order-table">
        <tr>
            <th>Order ID</th>
            <td>#<?php echo htmlspecialchars($order['order_id']); ?></td>
        </tr>
        <tr>
            <th>User</th>
            <td><i class="fas fa-user"></i> <?php echo htmlspecialchars($order['username']); ?></td>
        </tr>
        <tr>
            <th>Address</th>
            <td><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($order['address']); ?></td>
        </tr>
        <tr>
            <th>Total Amount</th>
            <td><i class="fas fa-wallet"></i> ₹<?php echo number_format($order['total_price'], 2); ?></td>
        </tr>
        <tr>
            <th>Status</th>
            <td>
                <span class="<?php echo $status_badge[$order['order_status']] ?? 'badge bg-secondary'; ?>">
                    <?php echo htmlspecialchars($order['order_status']); ?>
                </span>
            </td>
        </tr>
        <tr>
            <th>Order Date</th>
            <td><i class="fas fa-calendar-alt"></i> <?php echo date("d M Y, h:i A", strtotime($order['order_date'])); ?></td>
        </tr>
    </table>

    <div class="text-center mt-4">
        <a href="manage_orders.php" class="btn btn-secondary back-btn"><i class="fas fa-arrow-left"></i> Back to Orders</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
