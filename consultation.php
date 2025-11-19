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
    <title>Consultation Services | AgriService</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* 🌿 Background Styling */
        body {
            background: linear-gradient(to right, #e8f5e9, #c8e6c9);
        }

        /* ✅ Navbar */
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
            transition: 0.3s;
        }
        .nav-link:hover {
            color: #f8f9fa !important;
            transform: scale(1.1);
        }

        /* 📊 Consultation Header */
        .consultation-header {
            background: url('images/consultation.jpg') no-repeat center center/cover;
            height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
            font-size: 2rem;
            font-weight: bold;
            border-bottom: 5px solid #2d6a4f;
        }

        /* 🟩 Gradient Card Styling */
        .info-card {
            background: linear-gradient(to bottom right, #d4edda, #a3d9a5);
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.15);
            transition: 0.3s ease-in-out;
            border-left: 6px solid #2d6a4f;
        }
        .info-card:hover {
            transform: scale(1.05);
            box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.2);
            background: linear-gradient(to bottom right, #c3e6cb, #8bc34a);
        }

        .info-icon {
            font-size: 55px;
            color: #2d6a4f;
        }

        /* 🎯 Consult Now Button */
        .consult-btn {
            background: linear-gradient(45deg, #2d6a4f, #40916c);
            border: none;
            padding: 12px 30px;
            font-size: 1.2rem;
            border-radius: 30px;
            font-weight: bold;
            color: white;
            transition: 0.3s;
        }
        .consult-btn:hover {
            background: linear-gradient(45deg, #1b4533, #357a5b);
            transform: scale(1.1);
        }
    </style>
</head>
<body>

<!-- Header -->
<div class="consultation-header">
    📊 Professional Farming Consultation Services
</div>

<!-- Consultation Info -->
<div class="container mt-5">
    <h2 class="text-center text-success fw-bold">Why Consult with Us?</h2>
    <p class="text-center text-muted">Get expert advice on modern farming techniques, crop management, and sustainable agriculture.</p>

    <div class="row mt-4">
        <!-- Expert Advice -->
        <div class="col-md-4 mb-4">
            <div class="info-card text-center p-4">
                <i class="bi bi-person-check info-icon"></i>
                <h4 class="mt-3">Expert Advice</h4>
                <p>Get insights from experienced agricultural professionals.</p>
            </div>
        </div>

        <!-- Sustainable Practices -->
        <div class="col-md-4 mb-4">
            <div class="info-card text-center p-4">
                <i class="bi bi-globe2 info-icon"></i>
                <h4 class="mt-3">Sustainable Practices</h4>
                <p>Learn eco-friendly farming methods for better yield.</p>
            </div>
        </div>

        <!-- Crop & Soil Analysis -->
        <div class="col-md-4 mb-4">
            <div class="info-card text-center p-4">
                <i class="bi bi-bar-chart-line info-icon"></i>
                <h4 class="mt-3">Crop & Soil Analysis</h4>
                <p>Optimize your farm's productivity with scientific analysis.</p>
            </div>
        </div>
    </div>
</div>

<!-- Consult Now Button -->
<div class="text-center mt-4">
    <a href="contact.php" class="btn consult-btn">📞 Consult Now</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
