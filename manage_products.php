<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit();
}

$products = $conn->query("SELECT * FROM products");

while ($product = $products->fetch_assoc()) {
    echo "Product ID: " . $product['product_id'] . "<br>";
    echo "Name: " . $product['product_name'] . "<br>";
    echo "Price: " . $product['price'] . "<br>";
    echo "Stock: " . $product['stock'] . "<br>";
    // Add options to edit or delete the product
}
