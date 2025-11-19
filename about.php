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
    <title>About Us - AgriService</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .about-header {
            background: linear-gradient(45deg, #2d6a4f, #40916c);
            color: white;
            padding: 50px 0;
            text-align: center;
        }
        .about-section {
            padding: 60px 0;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .team img {
            border-radius: 50%;
            width: 120px;
            height: 120px;
            object-fit: cover;
            border: 4px solid #2d6a4f;
        }
        .team h5 {
            margin-top: 10px;
            color: #2d6a4f;
        }
        .vision-section, .mission-section {
            background: #d8f3dc;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .footer {
            background-color: #2d6a4f;
            color: white;
            text-align: center;
            padding: 10px;
        }
    </style>
</head>
<body>


<!-- Navbar -->
<?php include 'navbar.php';?>

<!-- About Header -->
<div class="about-header">
    <h1>About Us</h1>
    <p>Dedicated to providing the best agriculture solutions for farmers and businesses.</p>
</div>

<!-- About Content -->
<div class="container about-section">
    <div class="row align-items-center">
        <div class="col-lg-6">
            <h2 class="text-success">Who We Are</h2>
            <p>AgriService is a dedicated platform focused on empowering farmers with the best agricultural products and services. We aim to revolutionize farming by making top-quality tools, fertilizers, and technology easily accessible.</p>
        </div>
        <div class="col-lg-6 text-center">
            <img src="uploads/farmers.jpg" alt="Agriculture" class="img-fluid rounded">
        </div>
    </div>
</div>

<!-- Mission & Vision -->
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="mission-section">
                <h3 class="text-success"><i class="bi bi-flag"></i> Our Mission</h3>
                <p>To provide sustainable and innovative farming solutions that enhance productivity, reduce costs, and contribute to a greener planet.</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="vision-section">
                <h3 class="text-success"><i class="bi bi-eye"></i> Our Vision</h3>
                <p>To be the leading platform for modern agricultural solutions, making farming smarter, efficient, and environmentally friendly.</p>
            </div>
        </div>
    </div>
</div>

<!-- Our Team -->
<div class="container about-section">
    <h2 class="text-center text-success">Meet Our Team</h2>
    <div class="row text-center team">
        <div class="col-md-4">
            <img src="images/team1.jpg" alt="Team Member">
            <h5>Ketan Kubal</h5>
            <p>Founder & CEO</p>
        </div>
        <div class="col-md-4">
            <img src="images/team2.jpg" alt="Team Member">
            <h5>Shivram Sawant</h5>
            <p>Head of Operations</p>
        </div>
        <div class="col-md-4">
            <img src="images/team3.jpg" alt="Team Member">
            <h5>Abdul Aziz</h5>
            <p>Marketing Director</p>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="footer">
    <p>&copy; 2025 Agriculture Service. All rights reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
