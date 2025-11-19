<?php
session_start();
include 'includes/db_connect.php';

// Check if the cart session is set and not empty
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    die("❌ Error: Your cart is empty! Please add products before placing an order.");
}

// Ensure the user is logged in
$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    die("❌ Error: User not logged in!");
}

// Initialize variables
$cart = $_SESSION['cart'];
$payment_method = $_POST['payment_method'] ?? 'COD';  // Default to Cash on Delivery if not set
$total_price = 0;

// Calculate the total price
foreach ($cart as $product_id => $item) {
    if (!isset($item['price'], $item['quantity'])) {
        die("❌ Error: Missing price or quantity for product!");
    }
    $total_price += floatval($item['price']) * intval($item['quantity']);
}

// Begin MySQL transaction
mysqli_begin_transaction($conn);

try {
    // Insert order into 'orders' table (don't specify order_id as it will be auto-incremented)
    $stmt = $conn->prepare("INSERT INTO orders (user_id, total_price, payment_method, payment_status, created_at) 
                            VALUES (?, ?, ?, 'Pending', NOW())");
    $stmt->bind_param("ids", $user_id, $total_price, $payment_method);
    
    // Execute the query
    if (!$stmt->execute()) {
        die("❌ Error inserting order: " . $stmt->error);  // Print error if insertion fails
    }

    // Get the inserted order ID
    $order_id = $stmt->insert_id;
    if (!$order_id) {
        die("❌ Error: Failed to retrieve order_id.");  // Make sure the order_id is valid
    }

    // Insert each product into order_items table
    foreach ($cart as $product_id => $item) {
        $product_name = htmlspecialchars($item['name']);
        $quantity = intval($item['quantity']);
        $price = floatval($item['price']);

        // Insert into order_items table
        $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, product_name, quantity, price) 
                                VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iisid", $order_id, $product_id, $product_name, $quantity, $price);
        
        
    }

    // Commit transaction if everything is successful
    mysqli_commit($conn);

    // Clear the cart session
    unset($_SESSION['cart']);

    // Fetch order details from the order_items table (to show on the confirmation page)
    $order_details = [];
    $query = "SELECT oi.product_name, oi.quantity, oi.price, oi.product_id, p.product_image 
              FROM order_items oi 
              JOIN products p ON oi.product_id = p.product_id
              WHERE oi.order_id = ?";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $stmt->bind_result($product_name, $quantity, $price, $product_id, $product_image);

    while ($stmt->fetch()) {
        $order_details[] = [
            'product_name' => $product_name,
            'quantity' => $quantity,
            'price' => $price,
            'product_id' => $product_id,
            'product_image' => $product_image
        ];
    }

    // Store order details in session for use on confirmation page
    $_SESSION['order_details'] = $order_details;

    // Redirect to order confirmation page with order ID
    header("Location: order_confirmation.php?order_id=" . $order_id);
    exit();

} catch (Exception $e) {
    // Rollback if any error occurs
    mysqli_rollback($conn);
    die($e->getMessage());  // Display any error message
}
?>
