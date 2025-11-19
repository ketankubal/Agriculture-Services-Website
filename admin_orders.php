<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

include '../includes/db_connect.php';

$message = "";

// Handle Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $price = trim($_POST['price']);
    $description = trim($_POST['description']);
    $category = trim($_POST['category']);

    // Handle Image Upload
    $image = $_FILES['image']['name'];
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($image);
    $imageFileType = strtolower(pathinfo($target_file, flags: PATHINFO_EXTENSION));

    // Allowed File Types
    $allowed_types = ["jpg", "jpeg", "png", "gif"];
    
    if (empty($name) || empty($price) || empty($description) || empty($category) || empty($image)) {
        $message = "⚠️ All fields are required!";
    } elseif (!in_array($imageFileType, $allowed_types)) {
        $message = "⚠️ Only JPG, JPEG, PNG, and GIF files are allowed.";
    } elseif ($_FILES["image"]["size"] > 5000000) { // Limit: 5MB
        $message = "⚠️ Image size must be less than 5MB.";
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            
            // ✅ FIX: Check if query preparation was successful
            $query = "INSERT INTO products (name, price, description, category, image) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query);

            if (!$stmt) {
                die("⚠️ Query preparation failed: " . $conn->error); // ✅ Display SQL error message
            }

            $stmt->bind_param("sdsss", $name, $price, $description, $category, $image);
            
            if ($stmt->execute()) {
                $message = "✅ Product added successfully!";
            } else {
                $message = "⚠️ Failed to add product.";
            }

            $stmt->close();
        } else {
            $message = "⚠️ Error uploading the image.";
        }
    }
}

$conn->close();
?>
