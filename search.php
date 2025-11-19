<?php 
session_start();
include 'includes/db.php'; // Database connection
include 'includes/navbar.php'; // Navbar

$search = "";
$results_found = false;
$search_results = []; // Store search results

if (isset($_GET['query']) && !empty(trim($_GET['query']))) {
    $search = trim($_GET['query']);
    $search = mysqli_real_escape_string($conn, $search);

    // SQL Query - Case-insensitive search using LOWER()
    $sql = "SELECT * FROM products 
            WHERE LOWER(name) LIKE LOWER('%$search%') 
            OR LOWER(category) LIKE LOWER('%$search%') 
            OR LOWER(description) LIKE LOWER('%$search%')";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $results_found = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $search_results[] = $row; // Store matching products in an array
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results | AgriService</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .search-title { font-size: 1.5rem; color: #2d6a4f; font-weight: bold; }
        .search-term { color: #dc3545; }
        .card { transition: 0.3s; border-radius: 10px; }
        .card:hover { transform: scale(1.05); box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2); }
        .card-img-top { height: 200px; object-fit: cover; border-top-left-radius: 10px; border-top-right-radius: 10px; }
        .card-body { text-align: center; }
        .btn-success { background-color: #2d6a4f; border: none; }
        .btn-success:hover { background-color: #1b4332; }
    </style>
</head>
<body>

<div class="container mt-4">
    <h2 class="text-center search-title">🔍 Search Results for "<span class="search-term"><?php echo htmlspecialchars($search); ?></span>"</h2>

    <div class="row mt-4">
        <?php
        if ($results_found) {
            foreach ($search_results as $row) {
        ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow">
                        <img src="uploads/<?php echo $row['image']; ?>" class="card-img-top" alt="<?php echo $row['name']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['name']; ?></h5>
                            <p class="card-text"><?php echo substr($row['description'], 0, 80); ?>...</p>
                            <p class="fw-bold text-success">₹<?php echo $row['price']; ?></p>
                            <a href="product_details.php?id=<?php echo $row['id']; ?>" class="btn btn-success">View Product</a>
                        </div>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "<h4 class='text-danger text-center mt-4'>❌ No products found! Try a different keyword.</h4>";
        }
        ?>
    </div>
</div>

</body>
</html>
