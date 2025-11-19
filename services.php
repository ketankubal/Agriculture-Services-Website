<?php
session_start();
include 'navbar.php';



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
    <title>Our Services | AgriService</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        body {
            background: #f8f9fa;
        }
        

        

        /* Services Section */
        .service-card {
            color: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.1);
            transition: 0.4s;
            text-align: center;
            min-height: 220px;
        }
        .service-card:hover {
            transform: scale(1.05);
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
        }

        /* Unique Card Colors */
        .equipment-card { background: linear-gradient(135deg, #ff9a8b, #ff6f61); }
        .consultation-card { background: linear-gradient(135deg, #16a085, #1abc9c); }
        .soil-testing-card { background: linear-gradient(135deg, #e67e22, #f39c12); }
        .irrigation-card { background: linear-gradient(135deg, #2980b9, #3498db); }
        .logistics-card { background: linear-gradient(135deg, #9b59b6, #8e44ad); }
        .organic-card { background: linear-gradient(135deg, #2ecc71, #27ae60); }

        .service-icon {
            font-size: 50px;
            margin-bottom: 10px;
        }

        /* Button Styling */
        .btn-custom {
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid white;
            color: white;
            font-weight: bold;
            padding: 8px 15px;
            border-radius: 25px;
            transition: 0.3s;
        }
        .btn-custom:hover {
            background: white;
            color: black;
        }

        /* Footer */
        footer {
            background: rgba(0, 0, 0, 0.7);
            padding: 15px;
            color: white;
            text-align: center;
            margin-top: 50px;
        }
    </style>
</head>
<body>



<!-- Services Section -->
<div class="container mt-5">
    <h2 class="text-center text-success fw-bold">🌱 Our Agriculture Services</h2>
    <p class="text-center text-muted">Providing the best solutions to help farmers grow efficiently.</p>

    <div class="row mt-4">
        <!-- Equipment Rental -->
        <div class="col-md-4 mb-4">
            <div class="service-card equipment-card">
                <i class="bi bi-tools service-icon"></i>
                <h4>Equipment Rental</h4>
                <p>Rent modern farming equipment like tractors, harvesters, and irrigation systems at affordable rates.</p>
                <a href="equipment_rental.php" class="btn btn-custom">Learn More</a>
            </div>
        </div>

        <!-- Farming Consultation -->
        <div class="col-md-4 mb-4">
            <div class="service-card consultation-card">
                <i class="bi bi-lightbulb service-icon"></i>
                <h4>Farming Consultation</h4>
                <p>Expert guidance on crop planning, pest control, and improving farm productivity.</p>
                <a href="consultation.php" class="btn btn-custom">Learn More</a>
            </div>
        </div>

        <!-- Soil Testing -->
        <div class="col-md-4 mb-4">
            <div class="service-card soil-testing-card">
                <i class="bi bi-flask service-icon"></i>
                <h4>Soil Testing</h4>
                <p>Analyze soil health and get recommendations for fertilizers to boost yield.</p>
                <a href="soil_testing.php" class="btn btn-custom">Learn More</a>
            </div>
        </div>

        <!-- Irrigation Solutions -->
        <div class="col-md-4 mb-4">
            <div class="service-card irrigation-card">
                <i class="bi bi-water service-icon"></i>
                <h4>Irrigation Solutions</h4>
                <p>Drip and sprinkler irrigation setups to optimize water usage.</p>
                <a href="irrigation.php" class="btn btn-custom">Learn More</a>
            </div>
        </div>

        <!-- Logistics & Transport -->
        <div class="col-md-4 mb-4">
            <div class="service-card logistics-card">
                <i class="bi bi-truck service-icon"></i>
                <h4>Logistics & Transport</h4>
                <p>Fast and reliable transport services to deliver produce to markets efficiently.</p>
                <a href="logistics.php" class="btn btn-custom">Learn More</a>
            </div>
        </div>

        <!-- Organic Farming Support -->
        <div class="col-md-4 mb-4">
            <div class="service-card organic-card">
                <i class="bi bi-leaf service-icon"></i>
                <h4>Organic Farming Support</h4>
                <p>Training and resources for sustainable and chemical-free farming.</p>
                <a href="organic_farming.php" class="btn btn-custom">Learn More</a>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer>
    <p>&copy; 2025 Agriculture eCommerce. All Rights Reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
