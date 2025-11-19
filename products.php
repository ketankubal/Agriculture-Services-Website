<?php 
session_start();
include 'includes/db_connect.php';
include 'navbar.php';

// ✅ Fetch categories for filtering
$categoryQuery = "SELECT * FROM categories ORDER BY category_name ASC";
$categoryResult = $conn->query($categoryQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products | Agriculture eCommerce</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        /* ✅ Custom Styling for Product Cards */
        .product-card {
            border: 1px solid #ddd;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            height: 100%;
        }
        .product-card:hover {
            transform: scale(1.03);
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
        }
        .product-img {
            height: 200px;
            object-fit: cover;
            border-bottom: 1px solid #ddd;
        }
        .product-price {
            font-size: 18px;
            font-weight: bold;
            color: #28a745;
        }
        .product-buttons {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 5px;
        }
        .product-buttons .btn {
            flex: 1;
            min-width: 100px;
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <!-- ✅ Category Filter -->
    <div class="text-center mb-4">
        <form method="GET" action="products.php">
            <select name="category" class="form-select w-50 d-inline-block" onchange="this.form.submit()">
                <option value="">All Categories</option>
                <?php
                if ($categoryResult->num_rows > 0) {
                    while ($category = $categoryResult->fetch_assoc()) {
                        $selected = (isset($_GET['category']) && $_GET['category'] == $category['category_name']) ? 'selected' : '';
                        echo "<option value='" . htmlspecialchars($category['category_name']) . "' $selected>" . htmlspecialchars($category['category_name']) . "</option>";
                    }
                } else {
                    echo "<option disabled>No Categories Available</option>";
                }
                ?>
            </select>
        </form>
    </div>

    <?php
    if (!$conn) {
        die("<p class='text-center text-danger'>❌ Database Connection Error: " . mysqli_connect_error() . "</p>");
    }

    // ✅ Handle Search & Category Query
    $query = "SELECT * FROM products WHERE 1";
    $params = [];
    $types = "";

    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $search = "%" . mysqli_real_escape_string($conn, $_GET['search']) . "%";
        $query .= " AND (name LIKE ? OR description LIKE ?)";
        $params[] = $search;
        $params[] = $search;
        $types .= "ss";
    }

    if (isset($_GET['category']) && !empty($_GET['category'])) {
        $category = mysqli_real_escape_string($conn, $_GET['category']);
        $query .= " AND category = ?";
        $params[] = $category;
        $types .= "s";
    }

    $query .= " ORDER BY product_id DESC";

    // ✅ Prepare & Execute Query
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("<p class='text-center text-danger'>❌ SQL Error: " . $conn->error . "</p>");
    }

    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    // ✅ Display Products
    if ($result->num_rows > 0) {
        echo "<div class='row row-cols-1 row-cols-md-3 g-4'>";
        while ($row = $result->fetch_assoc()) {
            $price = (float)$row['price'] > 0 ? "₹" . number_format($row['price'], 2) : "Price Not Available";
            $imagePath = !empty($row['image']) ? "uploads/" . $row['image'] : "images/default.png";

            echo '
            <div class="col">
                <div class="card product-card h-100">
                    <img src="' . $imagePath . '" class="card-img-top product-img" alt="' . htmlspecialchars($row['name']) . '">
                    <div class="card-body text-center">
                        <h5 class="card-title">' . htmlspecialchars($row['name']) . '</h5>
                        <p class="card-text text-muted">' . htmlspecialchars(substr($row['description'], 0, 60)) . '...</p>
                        <p class="product-price">' . $price . '</p>
                        <div class="product-buttons">
                            <form action="add_to_cart.php" method="POST">
                                <input type="hidden" name="product_id" value="' . $row['product_id'] . '">
                                <button type="submit" class="btn btn-primary">🛒 Add to Cart</button>
                            </form>
                            <a href="checkout.php?id=' . urlencode($row['product_id']) . '" class="btn btn-success">💰 Buy Now</a>
                            <a href="view_product.php?id=' . urlencode($row['product_id']) . '" class="btn btn-info">🔍 View</a>
                        </div>
                    </div>
                </div>
            </div>';
        }
        echo "</div>";
    } else {
        echo "<p class='text-center'>No products found.</p>";
    }

    $stmt->close();
    ?>

</div>

<!-- Footer -->
<footer class="bg-success text-white text-center py-3 mt-4">
    <p>&copy; 2025 Agriculture eCommerce. All Rights Reserved.</p>
    <p>
        <a href="contact.php" class="text-light">Contact Us</a> |
        <a href="privacy.php" class="text-light">Privacy Policy</a>
    </p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
