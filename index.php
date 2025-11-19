<?php 
session_start();
include 'navbar.php'; // Navbar with search functionality
$username = isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : "Guest";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agriculture Project | Home</title>
    <meta name="description" content="Best online store for agriculture products and farming services. Buy seeds, fertilizers, and tools.">
    <meta name="keywords" content="agriculture, farming, seeds, fertilizers, equipment">
    <meta name="author" content="Your Website Name">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        /* Hero Section */
        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('images/hero-bg.jpg') center/cover no-repeat;
            height: 70vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            padding: 20px;
        }
        .hero-content {
            max-width: 600px;
        }
        .hero-content h1 {
            font-size: 2.8rem;
            font-weight: bold;
        }
        .hero-content p {
            font-size: 1.2rem;
            margin-bottom: 20px;
        }
        .hero-content .btn {
            padding: 10px 20px;
            font-size: 1.2rem;
            border-radius: 50px;
        }

        /* Carousel */
        .carousel-container {
            max-width: 900px;
            margin: auto;
            padding: 30px 0;
        }
        .carousel-item img {
            height: 400px;
            object-fit: cover;
            border-radius: 10px;
        }

        /* Feature Section */
        .features {
            padding: 60px 20px;
            background: #f8f9fa;
            text-align: center;
        }
        .feature-box {
            padding: 20px;
            transition: 0.3s;
        }
        .feature-box:hover {
            transform: translateY(-5px);
        }
        .feature-box i {
            font-size: 40px;
            color: #218838;
        }

        /* Footer */
        footer {
            background: #218838;
            padding: 20px;
            color: white;
            text-align: center;
            font-size: 14px;
        }
        footer a {
            color: #d4edda;
            text-decoration: none;
            font-weight: bold;
        }
        footer a:hover {
            text-decoration: underline;
        }
        .social-icons a {
            color: white;
            font-size: 20px;
            margin: 0 10px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-section {
                height: 50vh;
            }
            .hero-content h1 {
                font-size: 2rem;
            }
            .carousel-item img {
                height: 250px;
            }
        }
    </style>
</head>
<body>

<!-- Hero Section -->
<div class="hero-section">
    <div class="hero-content">
        <h1>Empowering Farmers, Growing Futures</h1>
        <p>Discover premium seeds, fertilizers, and tools for modern agriculture.</p>
        <a href="products.php" class="btn btn-warning btn-lg">
            <i class="bi bi-cart"></i> Shop Now
        </a>
    </div>
</div>

<!-- Image Slider -->
<div class="carousel-container">
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/slide_1.jpg" class="d-block w-100" alt="Farming Field">
            </div>
            <div class="carousel-item">
                <img src="images/slide_2.jpg" class="d-block w-100" alt="Fresh Crops">
            </div>
            <div class="carousel-item">
                <img src="images/slide_3.jpg" class="d-block w-100" alt="Agriculture Equipment">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>
    </div>
</div>

<!-- Features Section -->
<section class="features">
    <div class="container">
        <div class="row">
            <div class="col-md-4 feature-box">
                <i class="bi bi-seedling"></i>
                <h5>High-Quality Seeds</h5>
                <p>Grow healthier crops with our top-quality seeds.</p>
            </div>
            <div class="col-md-4 feature-box">
                <i class="bi bi-droplet"></i>
                <h5>Organic Fertilizers</h5>
                <p>Boost your yield with eco-friendly fertilizers.</p>
            </div>
            <div class="col-md-4 feature-box">
                <i class="bi bi-tools"></i>
                <h5>Modern Equipment</h5>
                <p>Upgrade your farming with the best tools.</p>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer>
    <p>© 2025 Agriculture Project. All rights reserved.</p>
    <p>
        <a href="contact.php">Contact Us</a> |
        <a href="privacy.php">Privacy Policy</a>
    </p>
    <div class="social-icons">
        <a href="#"><i class="bi bi-facebook"></i></a>
        <a href="#"><i class="bi bi-instagram"></i></a>
        <a href="#"><i class="bi bi-twitter"></i></a>
    </div>
</footer>

</body>
</html>
