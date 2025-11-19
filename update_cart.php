<?php
session_start();

if (isset($_GET['id']) && isset($_GET['action'])) {
    $product_id = $_GET['id'];
    $action = $_GET['action'];

    if (isset($_SESSION['cart'][$product_id])) {
        if ($action === "increase") {
            $_SESSION['cart'][$product_id]['quantity'] += 1;
        } elseif ($action === "decrease") {
            if ($_SESSION['cart'][$product_id]['quantity'] > 1) {
                $_SESSION['cart'][$product_id]['quantity'] -= 1;
            } else {
                unset($_SESSION['cart'][$product_id]); // Remove item if quantity is 1
            }
        } elseif ($action === "remove") {
            unset($_SESSION['cart'][$product_id]); // Remove item completely
        }
    }
}

// ✅ Redirect back to cart page
header("Location: cart.php");
exit();
