<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

include '../includes/db_connect.php';
include 'admin_header.php'; // Admin header file

$message = "";

// ✅ Handle category addition
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_name = trim($_POST['category_name']);

    if (empty($category_name)) {
        $message = "⚠️ Category name cannot be empty!";
    } else {
        // Check for duplicates
        $checkQuery = "SELECT * FROM categories WHERE category_name = ?";
        $stmt = $conn->prepare($checkQuery);
        $stmt->bind_param("s", $category_name);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $message = "⚠️ Category already exists!";
        } else {
            // Insert new category
            $insertQuery = "INSERT INTO categories (category_name) VALUES (?)";
            $stmt = $conn->prepare($insertQuery);
            $stmt->bind_param("s", $category_name);

            if ($stmt->execute()) {
                $message = "✅ Category added successfully!";
            } else {
                $message = "❌ Error adding category.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category | Admin Panel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body { background-color: #f8f9fa; }
        .container { max-width: 500px; margin-top: 50px; }
        h2 { color: #218838; font-weight: bold; }
        .btn-success { background: #28a745; }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center">Add New Category</h2>

    <?php if (!empty($message)): ?>
        <div class="alert alert-info text-center"><?php echo $message; ?></div>
    <?php endif; ?>

    <form action="" method="POST" class="p-4 border rounded bg-white shadow-sm">
        <div class="mb-3">
            <label for="category_name" class="form-label">Category Name:</label>
            <input type="text" class="form-control" name="category_name" required>
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-success">➕ Add Category</button>
        </div>
    </form>

    <div class="text-center mt-3">
        <a href="categories.php" class="btn btn-secondary">🔙 Back to Categories</a>
    </div>
</div>

</body>
</html>
