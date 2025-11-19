<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logistics & Transport | AgriService</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* Gradient Background */
        body {
            background: linear-gradient(to right, #e9f5e9, #d8f3dc);
        }

        /* Navbar Styling */
        .navbar {
            background: linear-gradient(45deg, #2d6a4f, #40916c);
            padding: 15px 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: white !important;
        }
        .nav-link {
            color: white !important;
            font-weight: 500;
            padding: 10px 15px;
            transition: 0.3s;
        }
        .nav-link:hover {
            color: #f8f9fa !important;
            transform: scale(1.1);
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(to right, rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.3)), 
                        url('images/logistics-banner.jpg') no-repeat center center/cover;
            color: white;
            text-align: center;
            padding: 100px 20px;
            border-radius: 10px;
        }

        /* Card Styling */
        .card {
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.3s ease-in-out;
        }
        .card:hover {
            transform: scale(1.03);
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
        }

        /* Button Styling */
        .btn {
            transition: all 0.3s ease-in-out;
        }
        .btn:hover {
            transform: scale(1.05);
        }
        .btn-primary {
            background-color: #40916c;
            border: none;
        }
        .btn-primary:hover {
            background-color: #1b4332;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <i class="bi bi-leaf"></i> AgriService
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="index.php"><i class="bi bi-house"></i> Home</a></li>
                <li class="nav-item"><a class="nav-link active" href="services.php"><i class="bi bi-gear"></i> Services</a></li>
                <li class="nav-item"><a class="nav-link" href="products.php"><i class="bi bi-shop"></i> Products</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php"><i class="bi bi-telephone"></i> Contact</a></li>
                <li class="nav-item"><a class="nav-link" href="cart.php"><i class="bi bi-basket2"></i> Cart</a></li>
                <li class="nav-item"><a class="nav-link" href="profile.php"><i class="bi bi-person-circle"></i> My Account</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<div class="container mt-4">
    <div class="hero">
        <h1>Reliable Logistics & Transport</h1>
        <p>We ensure smooth and efficient transport for your agricultural goods.</p>
        <a href="contact.php" class="btn btn-primary">Request a Service</a>
    </div>
</div>

<!-- Logistics Services Section -->
<div class="container my-5">
    <h2 class="text-center mb-4">🚛 Our Logistics Services</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <img src="images/farm-to-market.jpg" class="card-img-top" alt="Farm to Market Transport">
                <div class="card-body">
                    <h5 class="card-title">Farm-to-Market Transport</h5>
                    <p class="card-text">Fast and safe delivery of your fresh produce directly to the market.</p>
                    <a href="contact.php" class="btn btn-success">Learn More</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <img src="images/cold-storage.jpg" class="card-img-top" alt="Cold Storage Transport">
                <div class="card-body">
                    <h5 class="card-title">Cold Storage Transport</h5>
                    <p class="card-text">Temperature-controlled vehicles for perishable goods and dairy products.</p>
                    <a href="contact.php" class="btn btn-success">Learn More</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <img src="images/bulk-transport.jpg" class="card-img-top" alt="Bulk Transport">
                <div class="card-body">
                    <h5 class="card-title">Bulk Agricultural Transport</h5>
                    <p class="card-text">Efficient transportation of grains, fertilizers, and other bulk items.</p>
                    <a href="contact.php" class="btn btn-success">Learn More</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Call to Action -->
<div class="text-center my-5">
    <h3>Need a Reliable Transport Solution?</h3>
    <p>Contact us today for custom logistics solutions tailored to your agricultural needs.</p>
    <a href="contact.php" class="btn btn-lg btn-primary">Request Service</a>
</div>

<!-- Footer -->
<footer class="bg-dark text-light text-center py-3">
    <p>&copy; 2025 AgriService. All Rights Reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
