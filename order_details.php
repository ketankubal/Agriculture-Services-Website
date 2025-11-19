<?php 
session_start();
include 'includes/db_connect.php';

// ✅ Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// ✅ Validate order ID
if (!isset($_GET['id']) || empty($_GET['id']) || !is_numeric($_GET['id'])) {
    die("<div class='alert alert-danger text-center'>⚠ Invalid Order ID.</div>");
}

$order_id = intval($_GET['id']);
$user_id = $_SESSION['user_id'];

// ✅ Fetch Order Details
$order_sql = "SELECT id, total_price, payment_method, order_status, created_at 
              FROM orders WHERE id = ? AND user_id = ?";
$order_stmt = $conn->prepare($order_sql);
if (!$order_stmt) {
    die("<div class='alert alert-danger text-center'>SQL Error: " . $conn->error . "</div>");
}
$order_stmt->bind_param("ii", $order_id, $user_id);
$order_stmt->execute();
$order_result = $order_stmt->get_result();

if ($order_result->num_rows === 0) {
    die("<div class='alert alert-warning text-center'>⚠ Order not found.</div>");
}

$order = $order_result->fetch_assoc();
$order_stmt->close();

// ✅ Fetch Order Items
$items_sql = "SELECT oi.product_id, p.name, p.image, oi.quantity, oi.price, oi.subtotal
              FROM order_items oi
              JOIN products p ON oi.product_id = p.product_id
              WHERE oi.order_id = ?";
$items_stmt = $conn->prepare($items_sql);
if (!$items_stmt) {
    die("<div class='alert alert-danger text-center'>SQL Error: " . $conn->error . "</div>");
}
$items_stmt->bind_param("i", $order_id);
$items_stmt->execute();
$items_result = $items_stmt->get_result();

if ($items_result->num_rows === 0) {
    echo "<div class='alert alert-warning text-center'>⚠ No products found for this order.</div>";
}
$items_stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order Details | AgriShop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #f4f7f6;
            font-family: 'Poppins', sans-serif;
        }
        .order-card {
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background: white;
            padding: 20px;
        }
        .order-status {
            font-size: 16px;
            font-weight: bold;
            text-transform: capitalize;
        }
        .product-img {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 5px;
        }
        .table {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .table-hover tbody tr:hover {
            background: #f8f9fa;
        }
        .btn-custom {
            font-size: 16px;
            padding: 10px 20px;
            border-radius: 5px;
        }
        .badge {
            font-size: 14px;
            padding: 8px 12px;
            border-radius: 5px;
        }
        .badge-success { background: #28a745; }
        .badge-warning { background: #ffc107; }
        .badge-danger { background: #dc3545; }
        .badge-info { background: #17a2b8; }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center text-success mb-4"><i class="fas fa-receipt"></i> Order Details</h2>

    <div class="card order-card p-4 mb-4">
        <h4 class="text-primary"><i class="fas fa-info-circle"></i> Order Information</h4>
        <p><strong>Order ID:</strong> #<?php echo $order['id']; ?></p>
        <p><strong>Order Date:</strong> <?php echo date("d M Y, h:i A", strtotime($order['created_at'])); ?></p>
        <p><strong>Total:</strong> <span class="text-success">₹<?php echo number_format($order['total_price'], 2); ?></span></p>
        <p><strong>Payment Method:</strong> <?php echo strtoupper($order['payment_method']); ?></p>
        <p><strong>Status:</strong> 
            <?php
                $status = strtolower($order['order_status']);
                $badgeClass = ($status === "completed") ? "badge-success" :
                              (($status === "processing") ? "badge-warning" :
                              (($status === "cancelled") ? "badge-danger" : "badge-info"));
            ?>
            <span class="badge <?php echo $badgeClass; ?>"><?php echo ucfirst($status); ?></span>
        </p>

        <!-- ✅ Cancel Order Button (Only if order is Processing) -->
        <?php if ($order['order_status'] == 'Processing') { ?>
            <form action="cancel_order.php" method="POST" class="text-center mt-3">
                <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
                <button type="submit" class="btn btn-danger btn-custom"><i class="fas fa-times-circle"></i> Cancel Order</button>
            </form>
        <?php } ?>
    </div>

    <h4 class="text-primary"><i class="fas fa-box"></i> Ordered Products</h4>
    <div class="table-responsive">
        <table class="table table-hover table-striped text-center">
            <thead class="table-dark">
                <tr>
                    <th>Product</th>
                    <th>Image</th>
                    <th>Quantity</th>
                    <th>Price (₹)</th>
                    <th>Subtotal (₹)</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($item = $items_result->fetch_assoc()) { ?>
                <tr>
                    <td class="align-middle"><?php echo htmlspecialchars($item['name']); ?></td>
                    <td><img src="uploads/<?php echo htmlspecialchars($item['image']); ?>" class="product-img img-thumbnail"></td>
                    <td class="align-middle"><?php echo $item['quantity']; ?></td>
                    <td class="align-middle">₹<?php echo number_format($item['price'], 2); ?></td>
                    <td class="align-middle text-success">₹<?php echo number_format($item['subtotal'], 2); ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="text-center mt-4">
        <a href="my_orders.php" class="btn btn-secondary btn-custom"><i class="fas fa-arrow-left"></i> Back to Orders</a>
        <a href="products.php" class="btn btn-primary btn-custom"><i class="fas fa-shopping-basket"></i> Continue Shopping</a>
    </div>
</div>

</body>
</html>
