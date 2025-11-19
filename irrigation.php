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
    <title>Irrigation Solutions | AgriService</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* Soft Green Gradient Background */
        body {
            background: linear-gradient(to bottom,rgb(52, 109, 52),rgb(36, 228, 94));
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
            background: url('images/irrigation-banner.jpg') no-repeat center center/cover;
            color: white;
            text-align: center;
            padding: 100px 20px;
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
<div class="hero">
    <h1>Efficient Irrigation Solutions</h1>
    <p>Maximize your farm's water efficiency with our advanced irrigation solutions.</p>
    <a href="contact.php" class="btn btn-primary">Get a Consultation</a>
</div>

<!-- Irrigation Services Section -->
<div class="container my-5">
    <h2 class="text-center mb-4">💧 Our Irrigation Services</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <img src="images/drip-irrigation.jpg" class="card-img-top" alt="Drip Irrigation">
                <div class="card-body">
                    <h5 class="card-title">Drip Irrigation</h5>
                    <p class="card-text">Save water and increase efficiency with our modern drip irrigation systems.</p>
                    <a href="contact.php" class="btn btn-success">Learn More</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <img src="images/sprinkler-irrigation.jpg" class="card-img-top" alt="Sprinkler Irrigation">
                <div class="card-body">
                    <h5 class="card-title">Sprinkler Irrigation</h5>
                    <p class="card-text">Ensure even water distribution across your fields with advanced sprinkler systems.</p>
                    <a href="contact.php" class="btn btn-success">Learn More</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <img src="images/solar-irrigation.jpg" class="card-img-top" alt="Solar Powered Irrigation">
                <div class="card-body">
                    <h5 class="card-title">Solar Powered Irrigation</h5>
                    <p class="card-text">Reduce costs and promote sustainability with solar-powered water pumps.</p>
                    <a href="contact.php" class="btn btn-success">Learn More</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Call to Action -->
<div class="text-center my-5">
    <h3>Want to Upgrade Your Irrigation System?</h3>
    <p>Contact us today for expert solutions tailored to your farm's needs.</p>
    <a href="contact.php" class="btn btn-lg btn-primary">Get in Touch</a>
</div>

<!-- Footer -->
<footer class="bg-dark text-light text-center py-3">
    <p>&copy; 2025 AgriService. All Rights Reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
