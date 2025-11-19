<?php  
session_start();
include 'includes/db_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

// ✅ Ensure the form was submitted via POST and cart is not empty
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_SESSION['cart'])) {
    $_SESSION["order_error"] = "Invalid request or empty cart!";
    header("Location: checkout.php");
    exit();
}

// ✅ Retrieve and sanitize form data
$full_name = isset($_POST['full_name']) ? htmlspecialchars($_POST['full_name']) : "Not Provided";
$email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : "Not Provided";
$phone = isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : "Not Provided";
$address = isset($_POST['address']) ? htmlspecialchars($_POST['address']) : "Not Provided";
$payment_method = isset($_POST['payment_method']) ? htmlspecialchars($_POST['payment_method']) : "Not Provided";

// ✅ Ensure required fields are filled
if (empty($full_name) || empty($email) || empty($phone) || empty($address) || empty($payment_method)) {
    $_SESSION["order_error"] = "All fields are required!";
    header("Location: checkout.php");
    exit();
}

// ✅ Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION["order_error"] = "Invalid email format!";
    header("Location: checkout.php");
    exit();
}

// ✅ Calculate total price
$subtotal = array_sum(array_map(function($item) { 
    return $item['price'] * $item['quantity']; 
}, $_SESSION['cart']));
$delivery_charges = 50.00; // Fixed delivery charge
$total_amount = $subtotal + $delivery_charges;

// ✅ Insert order into `orders` table
$stmt = $conn->prepare("INSERT INTO orders (user_id, total_price, payment_method, payment_status, order_status, address, phone, full_name, email, delivery_charges) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    die("Order Insert Error: " . $conn->error);
}

// ✅ Set user_id or NULL if not logged in
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : NULL;
$payment_status = 'Pending';
$order_status = 'Processing';

// ✅ Bind parameters correctly
$stmt->bind_param("idsssssssd", $user_id, $total_amount, $payment_method, $payment_status, $order_status, $address, $phone, $full_name, $email, $delivery_charges);

if (!$stmt->execute()) {
    die("Order Insertion Error: " . $stmt->error);
}

$order_id = $stmt->insert_id; // Get last inserted order ID
$stmt->close();

// ✅ Insert order items into `order_items` table
$stmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price, subtotal) VALUES (?, ?, ?, ?, ?)");

if (!$stmt) {
    die("Order Item Insert Error: " . $conn->error);
}

foreach ($_SESSION['cart'] as $product_id => $item) {
    if ($product_id == 0 || empty($product_id)) {
        continue;
    }

    // Check if product exists before inserting
    $check_product = $conn->prepare("SELECT product_id FROM products WHERE product_id = ?");
    $check_product->bind_param("i", $product_id);
    $check_product->execute();
    $check_product->store_result();

    if ($check_product->num_rows > 0) {
        $quantity = $item['quantity'];
        $price = $item['price'];
        $subtotal = $price * $quantity;

        $stmt->bind_param("iiidd", $order_id, $product_id, $quantity, $price, $subtotal);
        if (!$stmt->execute()) {
            die("Order Item Insertion Error: " . $stmt->error);
        }
    } else {
        echo "⚠ Product ID $product_id does not exist in the database. Skipping...<br>";
    }

    $check_product->close();
}
$stmt->close();

// ✅ Clear the cart after order placement
unset($_SESSION['cart']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order Confirmation | AgriShop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body {
            background: #f4f4f4;
        }
        .confirmation-container {
            max-width: 600px;
            margin: auto;
            margin-top: 50px;
            padding: 30px;
            background: white;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
        }
        .confirmation-container h2 {
            color: #28a745;
            font-weight: bold;
        }
        .order-details {
            text-align: left;
            padding: 20px;
        }
        .order-details p {
            font-size: 16px;
            margin: 5px 0;
        }
        .order-details i {
            color: #28a745;
            margin-right: 8px;
        }
        .btn-custom {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="confirmation-container">
    <h2><i class="fas fa-check-circle"></i> Order Placed Successfully!</h2>
    <hr>
    
    <div class="order-details">
        <p><i class="fas fa-receipt"></i> <strong>Order ID:</strong> #<?php echo $order_id; ?></p>
        <p><i class="fas fa-user"></i> <strong>Name:</strong> <?php echo $full_name; ?></p>
        <p><i class="fas fa-envelope"></i> <strong>Email:</strong> <?php echo $email; ?></p>
        <p><i class="fas fa-phone"></i> <strong>Phone:</strong> <?php echo $phone; ?></p>
        <p><i class="fas fa-map-marker-alt"></i> <strong>Address:</strong> <?php echo $address; ?></p>
        <p><i class="fas fa-credit-card"></i> <strong>Payment Method:</strong> <?php echo $payment_method; ?></p>
        <p><i class="fas fa-truck"></i> <strong>Delivery Charges:</strong> ₹<?php echo number_format($delivery_charges, 2); ?></p>
        <h3><i class="fas fa-wallet"></i> Total: ₹<?php echo number_format($total_amount, 2); ?></h3>
    </div>

    <a href="index.php" class="btn btn-success btn-custom"><i class="fas fa-home"></i> Go to Home</a>
    <a href="products.php" class="btn btn-primary btn-custom"><i class="fas fa-shopping-cart"></i> Continue Shopping</a>
</div>

</body>
</html>
