<?php
session_start();
include 'includes/db_connect.php';
include 'navbar.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

// ✅ Ensure user is logged in before proceeding
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?message=Please+login+to+proceed+to+checkout");
    exit();
}

$user_id = $_SESSION['user_id']; // ✅ Get user ID from session

// ✅ If "Buy Now" is clicked, add the product to session temporarily
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $product_id = (int) $_GET['id'];

    // Fetch product details
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();

        // ✅ Store product details in session for Buy Now
        $_SESSION['cart'] = [
            [
                'product_id' => $product['product_id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => 1, // Default quantity for Buy Now
                'image' => $product['image']
            ]
        ];
    } else {
        die("<div class='container text-center mt-5'><h2 class='text-danger'>❌ Product Not Found!</h2><a href='products.php' class='btn btn-primary mt-3'>🔙 Go Back</a></div>");
    }
}

// ✅ Ensure cart is not empty
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    die("<div class='container text-center mt-5'><h2 class='text-danger'>🛒 Your cart is empty!</h2><a href='products.php' class='btn btn-primary mt-3'>🛍 Go Shopping</a></div>");
}

// ✅ Calculate total price and items count
$total_price = 0;
$total_items = 0;
foreach ($_SESSION['cart'] as $item) {
    $total_price += $item['quantity'] * $item['price'];
    $total_items += $item['quantity'];
}

// ✅ Delivery Charges Logic
$delivery_charge = 50; // Default delivery charge
$free_delivery_threshold = 500;

if ($total_price >= $free_delivery_threshold) {
    $delivery_charge = 0; // Free delivery
}

$final_price = $total_price + $delivery_charge;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout | AgriShop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script>
        function validateCheckout() {
            let email = document.getElementById("email").value.trim();
            let phone = document.getElementById("phone").value.trim();
            let address = document.getElementById("address").value.trim();
            
            // Email Validation
            let emailPattern = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;
            if (!emailPattern.test(email)) {
                alert("❌ Please enter a valid Gmail address (example@gmail.com).");
                return false;
            }

            // Phone Validation (10-digit Indian numbers)
            let phonePattern = /^[6-9]\d{9}$/;
            if (!phonePattern.test(phone)) {
                alert("❌ Please enter a valid 10-digit Indian mobile number.");
                return false;
            }

            // Address Validation (Minimum 10 characters)
            if (address.length < 10) {
                alert("❌ Please enter a valid address (at least 10 characters).");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>

<div class="container mt-5 checkout-container">
    <h2 class="text-center text-success mb-4">🛍 Checkout</h2>

    <div class="table-responsive">
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Image</th>
                    <th>Quantity</th>
                    <th>Price (₹)</th>
                    <th>Subtotal (₹)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['cart'] as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['name'] ?? 'Unknown Product'); ?></td>
                        <td><img src="uploads/<?php echo htmlspecialchars($item['image']); ?>" alt="Product Image" width="80"></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td>₹<?php echo number_format($item['price'], 2); ?></td>
                        <td>₹<?php echo number_format($item['quantity'] * $item['price'], 2); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <h3 class="text-end">Subtotal: <strong class="text-primary">₹<?php echo number_format($total_price, 2); ?></strong></h3>
    <h3 class="text-end">Delivery: 
        <?php if ($delivery_charge == 0): ?>
            <strong class="text-success">🎉 Free Delivery!</strong>
        <?php else: ?>
            <strong class="text-danger">₹<?php echo number_format($delivery_charge, 2); ?></strong>
        <?php endif; ?>
    </h3>
    <h3 class="text-end">Final Total: <strong class="text-success">₹<?php echo number_format($final_price, 2); ?></strong></h3>

    <div class="card mt-4">
        <h4 class="text-center text-primary">📦 Delivery Details</h4>
        <form action="order_confirmation.php" method="post" onsubmit="return validateCheckout()">
            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id, ENT_QUOTES, 'UTF-8'); ?>"> 
            <input type="hidden" name="total_price" value="<?php echo htmlspecialchars($total_price, ENT_QUOTES, 'UTF-8'); ?>">
            <input type="hidden" name="delivery_charge" value="<?php echo htmlspecialchars($delivery_charge, ENT_QUOTES, 'UTF-8'); ?>">
            <input type="hidden" name="final_price" value="<?php echo htmlspecialchars($final_price, ENT_QUOTES, 'UTF-8'); ?>">

            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="full_name" class="form-control" placeholder="Enter your full name" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Phone Number</label>
                <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter your phone number" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Delivery Address</label>
                <textarea name="address" id="address" class="form-control" rows="3" placeholder="Enter your full address" required></textarea>
            </div>
            <div class="mb-3"><label class="form-label">Payment Method</label><div class="form-check">
                <input class="form-check-input" type="radio" name="payment_method" value="COD" checked required>
                <label class="form-check-label">💰 Cash on Delivery (COD)</label>
            </div></div>


            <button type="submit" class="btn btn-success w-100">✅ Confirm Order</button>
        </form>
    </div>
</div>

</body>
</html>
