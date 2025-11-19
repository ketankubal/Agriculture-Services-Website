<?php
session_start();
include 'includes/db_connect.php';

// ✅ Prevent guest users from proceeding
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?message=Please+login+to+buy+products");
    exit();
}

// ✅ Check if product_id is provided via GET
if (!isset($_GET['product_id']) || empty($_GET['product_id'])) {
    die("<div class='alert alert-danger text-center'>❌ Product ID missing! <a href='products.php'>Go Back</a></div>");
}

$product_id = intval($_GET['product_id']);

// ✅ Fetch product details from the database
$query = "SELECT product_id, name, price, image FROM products WHERE product_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();
$stmt->close();

// ✅ If product not found, show an error
if (!$product) {
    die("<div class='alert alert-danger text-center'>❌ Product not found! <a href='products.php'>Go Back</a></div>");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Buy Now | AgriShop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- ✅ Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .buy-now-container { margin-top: 50px; }
        .product-img { width: 100%; max-width: 300px; height: auto; border-radius: 10px; }
        .card { box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); }
    </style>
</head>
<body>

<div class="container buy-now-container">
    <h2 class="text-center text-success mb-4">🛒 Buy Now</h2>

    <div class="card mx-auto" style="max-width: 500px;">
        <img src="uploads/<?php echo htmlspecialchars($product['image'] ?: 'default.jpg'); ?>" class="card-img-top product-img" alt="<?php echo htmlspecialchars($product['name']); ?>">
        
        <div class="card-body text-center">
            <h4 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h4>
            <p class="card-text"><strong>Price:</strong> ₹<?php echo number_format($product['price'], 2); ?></p>

            <!-- ✅ Order Placement Form -->
            <form action="checkout.php" method="POST">
                <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                <input type="hidden" name="quantity" value="1">
                <button type="submit" class="btn btn-success w-100">Proceed to Checkout</button>
            </form>

            <a href="products.php" class="btn btn-secondary mt-2 w-100">Cancel</a>
        </div>
    </div>
</div>

<!-- ✅ Include Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
