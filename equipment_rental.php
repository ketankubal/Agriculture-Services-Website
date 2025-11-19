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
    <title>Equipment Rental | AgriService</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* 🌿 Gradient Background */
        body {
            background: linear-gradient(to right, #cfe6d2, #a3d9a5, #74c69d);
            font-family: 'Arial', sans-serif;
            color: #333;
        }

        /* ✅ Navbar */
        .navbar {
            background: linear-gradient(45deg, #2d6a4f, #40916c);
            padding: 15px 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }
        .navbar-brand {
            font-size: 1.6rem;
            font-weight: bold;
            color: white !important;
        }
        .nav-link {
            color: white !important;
            font-weight: 500;
            transition: 0.3s ease-in-out;
        }
        .nav-link:hover {
            color: #d1f7c4 !important;
            transform: scale(1.1);
        }

        /* 🌾 Equipment Header */
        .equipment-header {
            background: url('images/equipment_rental.jpg') no-repeat center center/cover;
            height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
            font-size: 2.2rem;
            font-weight: bold;
            border-bottom: 5px solid #2d6a4f;
        }

        /* ✅ Info Card Styling */
        .info-card {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.15);
            transition: 0.3s;
            border-left: 5px solid #2d6a4f;
        }
        .info-card:hover {
            transform: scale(1.05);
            box-shadow: 0px 8px 25px rgba(0, 0, 0, 0.2);
            background: rgba(255, 255, 255, 1);
        }
        .info-icon {
            font-size: 50px;
            color: #2d6a4f;
        }

        /* ✅ Rent Button */
        .rent-btn {
            background: linear-gradient(45deg, #2d6a4f, #40916c);
            border: none;
            padding: 12px 25px;
            font-size: 1.2rem;
            border-radius: 30px;
            transition: 0.3s;
            font-weight: bold;
            color: white;
        }
        .rent-btn:hover {
            background: linear-gradient(45deg, #1b4533, #357a5b);
            transform: scale(1.1);
        }
    </style>
</head>
<body>

<!-- ✅ Navbar -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="index.php">AgriService</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="products.php">Products</a></li>
                <li class="nav-item"><a class="nav-link active" href="equipment_rental.php">Equipment Rental</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
                <li class="nav-item"><a class="nav-link" href="my_account.php">My Account</a></li>
                <li class="nav-item">
                    <a class="nav-link btn btn-danger text-white px-3 ms-3" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Header -->
<div class="equipment-header">
    🚜 Rent High-Quality Farming Equipment
</div>

<!-- Equipment Rental Info -->
<div class="container mt-5">
    <h2 class="text-center text-success fw-bold">Why Rent Agricultural Equipment?</h2>
    <p class="text-center text-muted">Renting farming equipment is cost-effective and provides access to the latest technology.</p>

    <div class="row mt-4">
        <!-- Cost-Effective -->
        <div class="col-md-4 mb-4">
            <div class="info-card text-center p-4">
                <i class="bi bi-cash-coin info-icon"></i>
                <h4 class="mt-3">Cost-Effective</h4>
                <p>Save money by renting instead of buying expensive machinery.</p>
            </div>
        </div>

        <!-- Modern Equipment -->
        <div class="col-md-4 mb-4">
            <div class="info-card text-center p-4">
                <i class="bi bi-gear-wide-connected info-icon"></i>
                <h4 class="mt-3">Modern Equipment</h4>
                <p>Get access to the latest and most efficient farming tools.</p>
            </div>
        </div>

        <!-- Flexible Rental Plans -->
        <div class="col-md-4 mb-4">
            <div class="info-card text-center p-4">
                <i class="bi bi-calendar-check info-icon"></i>
                <h4 class="mt-3">Flexible Rental Plans</h4>
                <p>Choose from daily, weekly, or monthly rental options.</p>
            </div>
        </div>
    </div>

    <h3 class="text-center text-success mt-5">🌾 Available Equipment for Rent</h3>
    <ul class="list-group list-group-flush text-center">
        <li class="list-group-item">✔️ Tractors</li>
        <li class="list-group-item">✔️ Harvesters</li>
        <li class="list-group-item">✔️ Irrigation Pumps</li>
        <li class="list-group-item">✔️ Plowing Machines</li>
        <li class="list-group-item">✔️ Fertilizer Spreaders</li>
    </ul>
</div>

<!-- Rent Now Button -->
<div class="text-center mt-4">
    <a href="contact.php" class="btn rent-btn">🚜 Rent Equipment Now</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
