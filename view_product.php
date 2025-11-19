<?php  
session_start();
include 'includes/db_connect.php';
include 'navbar.php'; // Navbar with search functionality

// Validate product ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("<div class='alert alert-danger text-center'>❌ Product ID missing! <a href='products.php'>Go Back</a></div>");
}

$product_id = intval($_GET['id']);
$query = "SELECT * FROM products WHERE product_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$product = $stmt->get_result()->fetch_assoc();

if (!$product) {
    die("<div class='alert alert-danger text-center'>❌ Product not found! <a href='products.php'>Go Back</a></div>");
}

// Delivery charges logic
$delivery_charge = 50; // Default delivery charge
$free_delivery_threshold = 500; // Free delivery if price is ₹500 or more

if ($product['price'] >= $free_delivery_threshold) {
    $delivery_message = "<span class='text-success fw-bold'>🎉 Free Delivery!</span>";
    $total_price = $product['price']; // No extra charge
} else {
    $delivery_message = "<span class='text-danger fw-bold'>🚚 Delivery Charge: ₹$delivery_charge</span>";
    $total_price = $product['price'] + $delivery_charge; // Add delivery charge
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo htmlspecialchars($product['name']); ?> | AgriService</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; }
        .product-container { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); }
        .price { font-size: 24px; font-weight: bold; color: #2d6a4f; }
        .btn-buy { background: linear-gradient(45deg, #2d6a4f, #40916c); color: white; border: none; }
        .btn-buy:hover { background: #1b4332; }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <img src="uploads/<?php echo htmlspecialchars($product['image']); ?>" class="img-fluid rounded shadow-sm">
        </div>
        <div class="col-md-6">
            <div class="product-container">
                <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                <p class="text-muted"><?php echo htmlspecialchars($product['description']); ?></p>
                <p class="price">₹<?php echo number_format($product['price'], 2); ?></p>
                
                <!-- Delivery Message -->
                <p><?php echo $delivery_message; ?></p>
                <p class="fw-bold">Total Price: ₹<?php echo number_format($total_price, 2); ?></p>

                <!-- Buttons -->
                <a href="add_to_cart.php?product_id=<?php echo urlencode($product_id); ?>" class="btn btn-buy btn-lg me-2">
                    <i class="bi bi-cart-plus"></i> Add to Cart
                </a>
                <a href="buy_now.php?product_id=<?php echo urlencode($product_id); ?>" class="btn btn-dark btn-lg">
                    <i class="bi bi-lightning"></i> Buy Now
                </a>
                
                <p class="mt-3"><a href="products.php" class="text-decoration-none">
                    <i class="bi bi-arrow-left"></i> Back to Products
                </a></p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
