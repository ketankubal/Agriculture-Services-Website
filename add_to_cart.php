<?php
session_start();
include 'includes/db_connect.php'; // ✅ Database connection

// ✅ Prevent users from adding to cart without logging in
if (!isset($_SESSION['user_id'])) {
    echo "<script>
        alert('❌ Please login to add items to your cart.');
        window.location.href = 'login.php';
    </script>";
    exit();
}

// ✅ Check if the request is POST and product_id is set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["product_id"])) {
    $product_id = intval($_POST["product_id"]); // ✅ Ensure it's an integer

    // ✅ Fetch product details from the database
    $stmt = $conn->prepare("SELECT product_id, name, price, image FROM products WHERE product_id = ?");
    if (!$stmt) {
        echo "<script>
            alert('❌ SQL Error: " . $conn->error . "');
            window.location.href = 'products.php';
        </script>";
        exit();
    }

    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();

        // ✅ Initialize the cart if not set
        if (!isset($_SESSION["cart"])) {
            $_SESSION["cart"] = [];
        }

        // ✅ If the product is already in the cart, increase quantity
        if (isset($_SESSION["cart"][$product_id])) {
            $_SESSION["cart"][$product_id]["quantity"] += 1;
        } else {
            $_SESSION["cart"][$product_id] = [
                "name" => htmlspecialchars($product["name"]),
                "price" => floatval($product["price"]),
                "image" => htmlspecialchars($product["image"]),
                "quantity" => 1
            ];
        }

        // ✅ Show alert and redirect back
        echo "<script>
            alert('✅ Product added to cart!');
            window.location.href = 'products.php';
        </script>";
        exit();
    } else {
        echo "<script>
            alert('❌ Product not found!');
            window.location.href = 'products.php';
        </script>";
    }

    $stmt->close();
    exit();
}

// ✅ If accessed without a proper request
echo "<script>
    alert('❌ Invalid request!');
    window.location.href = 'products.php';
</script>";
exit();
?>
