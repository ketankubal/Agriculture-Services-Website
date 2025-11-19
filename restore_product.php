<?php
session_start();
include '../includes/db_connect.php'; // Ensure correct database connection

if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);

    // Restore product by setting status to 'active'
    $query = "UPDATE products SET status = 'active' WHERE product_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $product_id);

    if ($stmt->execute()) {
        echo "<script>
            alert('✅ Product has been restored successfully!');
            window.location.href='manage_products.php';
        </script>";
    } else {
        echo "<script>
            alert('❌ Failed to restore product!');
            window.location.href='manage_products.php';
        </script>";
    }

    $stmt->close();
} else {
    echo "<script>
        alert('⚠ Invalid request!');
        window.location.href='manage_products.php';
    </script>";
}

$conn->close();
?>
