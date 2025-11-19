<?php
session_start();
include 'includes/db_connect.php';

// ✅ Check if cart or buy_now session exists
if (!isset($_SESSION['cart']) && !isset($_SESSION['buy_now'])) {
    header("Location: cart.php?message=empty");
    exit();
}

// ✅ Handle both Cart & Buy Now scenarios
$order_products = isset($_SESSION['buy_now']) ? [$_SESSION['buy_now']] : $_SESSION['cart'];

// ✅ Collect Form Data
$customer_name = $_POST['full_name'] ?? '';
$customer_email = $_POST['email'] ?? '';
$customer_phone = $_POST['phone'] ?? '';
$customer_address = $_POST['address'] ?? '';
$payment_method = $_POST['payment_method'] ?? 'COD';
$total_amount = $_POST['total_amount'] ?? 0;
$upi_txn_id = $_POST['upi_txn_id'] ?? null;

// ✅ Validate Form Data
if (empty($customer_name) || empty($customer_email) || empty($customer_phone) || empty($customer_address)) {
    die("Error: Missing customer details!");
}

// ✅ If UPI is selected, transaction ID is required
if ($payment_method == "UPI" && empty($upi_txn_id)) {
    die("Error: Please enter UPI transaction ID!");
}

// ✅ Insert Order into `orders` Table
$query = "INSERT INTO orders (customer_name, customer_email, phone, customer_address, payment_method, total_price, status, upi_txn_id) 
          VALUES (?, ?, ?, ?, ?, ?, 'Pending', ?)";
$stmt = $conn->prepare($query);
if (!$stmt) {
    die("Order Insertion Failed: " . $conn->error);
}
$stmt->bind_param("ssssdds", $customer_name, $customer_email, $customer_phone, $customer_address, $payment_method, $total_amount, $upi_txn_id);
$stmt->execute();
$order_id = $stmt->insert_id; // Get last inserted order ID

// ✅ Insert Order Items into `order_items` Table
foreach ($order_products as $product) {
    if (!isset($product['product_id'], $product['name'], $product['quantity'], $product['price'])) {
        die("Error: Missing product details in cart session!");
    }

    $product_id = $product['product_id'];
    $product_name = $product['name'];
    $quantity = $product['quantity'];
    $price = $product['price'];

    $query = "INSERT INTO order_items (order_id, product_id, product_name, quantity, price) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Order Items Query Failed: " . $conn->error);
    }
    $stmt->bind_param("iisid", $order_id, $product_id, $product_name, $quantity, $price);
    $stmt->execute();
}

// ✅ Clear Cart or Buy Now After Order
if (isset($_SESSION['buy_now'])) {
    unset($_SESSION['buy_now']);
} else {
    unset($_SESSION['cart']);
}

// ✅ Redirect to Order Confirmation Page
header("Location: order_confirmation.php?order_id=$order_id");
exit();
?>
