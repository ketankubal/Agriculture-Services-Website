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
    <title>Organic Farming | AgriService</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background:rgb(138, 212, 144);
        }
        
        /* Navbar Styling */
        .navbar {
            background: linear-gradient(135deg, #1b4332,rgb(18, 214, 28), #74c69d);
            padding: 12px 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }
        
        .navbar-brand {
            font-size: 1.7rem;
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
            background: rgba(255, 255, 255, 0.2);
            border-radius: 5px;
            color: #f8f9fa !important;
            transform: scale(1.1);
        }
        
        .navbar-toggler {
            border: none;
            background: white;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .navbar-toggler-icon {
            filter: invert(1);
        }
        
        /* Header Section */
        .organic-header {
            background: url('images/organic_farming.jpg') no-repeat center center/cover;
            height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
            font-size: 2rem;
            font-weight: bold;
        }
        
        /* Info Card */
        .info-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
        }
        
        .info-card:hover {
            transform: scale(1.05);
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
        }
        
        .info-icon {
            font-size: 50px;
            color: #2d6a4f;
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

<!-- Header -->
<div class="organic-header">
    🌿 Organic Farming - A Sustainable Future
</div>

<!-- Organic Farming Info -->
<div class="container mt-5">
    <h2 class="text-center text-success fw-bold">What is Organic Farming?</h2>
    <p class="text-center text-muted">Organic farming is a sustainable method of agriculture that avoids synthetic fertilizers and pesticides.</p>

    <div class="row mt-4">
        <!-- No Chemicals -->
        <div class="col-md-4 mb-4">
            <div class="info-card text-center p-4">
                <i class="bi bi-x-circle-fill info-icon"></i>
                <h4 class="mt-3">No Chemicals</h4>
                <p>We use natural fertilizers like compost and manure instead of harmful chemicals.</p>
            </div>
        </div>

        <!-- Healthy Soil -->
        <div class="col-md-4 mb-4">
            <div class="info-card text-center p-4">
                <i class="bi bi-flower1 info-icon"></i>
                <h4 class="mt-3">Healthy Soil</h4>
                <p>Soil health is maintained using crop rotation, cover crops, and natural compost.</p>
            </div>
        </div>

        <!-- Eco-Friendly -->
        <div class="col-md-4 mb-4">
            <div class="info-card text-center p-4">
                <i class="bi bi-globe2 info-icon"></i>
                <h4 class="mt-3">Eco-Friendly</h4>
                <p>Organic farming reduces pollution and protects biodiversity for a greener planet.</p>
            </div>
        </div>
    </div>

    <h3 class="text-center text-success mt-5">🌾 Benefits of Organic Farming</h3>
    <ul class="list-group list-group-flush text-center">
        <li class="list-group-item">✔️ Produces healthier food without chemicals</li>
        <li class="list-group-item">✔️ Improves soil fertility and biodiversity</li>
        <li class="list-group-item">✔️ Reduces water pollution and greenhouse gases</li>
        <li class="list-group-item">✔️ Supports local farmers and sustainable agriculture</li>
    </ul>
</div>

<!-- Get Started Button -->
<div class="text-center mt-4">
    <a href="contact.php" class="btn btn-lg btn-success">Get Started with Organic Farming</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
