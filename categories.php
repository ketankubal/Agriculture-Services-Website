<?php 
include 'db_connection.php'; // Include database connection

// Fetch categories from the database
$sql = "SELECT * FROM categories ORDER BY category_name ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories - Agriculture Service</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background: url('images/background-image.jpg') no-repeat center center/cover;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
        }
        .category-card {
            border-radius: 15px;
            overflow: hidden;
            text-align: center;
            padding: 25px;
            font-size: 18px;
            font-weight: bold;
            background: #28a745;
            color: white;
            transition: 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 150px;
        }
        .category-card:hover {
            background: #218838;
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        }
        .category-link {
            text-decoration: none;
            color: white;
        }
    </style>
</head>
<body>

<div class="container text-center">
    <h2 class="mb-4">🌱 Agriculture Categories</h2>
    <div class="row justify-content-center">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "
                <div class='col-md-4 col-lg-3 mb-3'>
                    <a href='products.php?category=" . urlencode($row['category_name']) . "' class='category-link'>
                        <div class='category-card'>" . htmlspecialchars($row['category_name']) . "</div>
                    </a>
                </div>";
            }
        } else {
            echo "<p class='text-center'>No categories found.</p>";
        }
        $conn->close();
        ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
