<?php
session_start();
include('../config.php'); // ✅ Database connection

if (isset($_GET['id'])) {
    $category_id = $_GET['id'];

    // ✅ Check if the category exists before deleting
    $checkQuery = "SELECT * FROM categories WHERE id = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("i", $category_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // ✅ Delete the category
        $deleteQuery = "DELETE FROM categories WHERE id = ?";
        $stmt = $conn->prepare($deleteQuery);
        $stmt->bind_param("i", $category_id);

        if ($stmt->execute()) {
            $_SESSION['message'] = "✅ Category deleted successfully!";
        } else {
            $_SESSION['message'] = "❌ Error deleting category.";
        }
    } else {
        $_SESSION['message'] = "⚠️ Category not found!";
    }
} else {
    $_SESSION['message'] = "⚠️ Invalid request!";
}

// ✅ Redirect back to categories.php
header("Location: categories.php");
exit();
?>
