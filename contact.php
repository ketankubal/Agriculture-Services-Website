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
    <title>Contact Us - AgriService</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: rgb(180, 235, 230);
        }
        .contact-section {
            background: linear-gradient(45deg, #2d6a4f, #40916c);
            color: white;
            padding: 50px 0;
            text-align: center;
        }
        .contact-form {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        .social-icons a {
            font-size: 24px;
            margin: 0 10px;
            color: #2d6a4f;
            transition: 0.3s;
        }
        .social-icons a:hover {
            color: #1b4332;
            transform: scale(1.2);
        }
        .error-message {
            color: red;
            font-size: 14px;
        }
    </style>
    <script>
        function validateEmail() {
            let emailInput = document.getElementById("email").value;
            let errorDiv = document.getElementById("emailError");
            let regex = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;

            if (!regex.test(emailInput)) {
                errorDiv.innerHTML = "⚠️ Please enter a valid Gmail address (e.g., example@gmail.com).";
                return false;
            } else {
                errorDiv.innerHTML = "";
                return true;
            }
        }
        
        function validateForm() {
            return validateEmail();
        }
    </script>
</head>
<body>

<!-- Contact Header Section -->
<div class="contact-section">
    <h1>Contact Us</h1>
    <p>We’d love to hear from you! Get in touch with us for any inquiries.</p>
</div>

<!-- Contact Details & Form Section -->
<div class="container mt-5">
    <div class="row">
        <!-- Contact Details -->
        <div class="col-lg-6 mb-4">
            <h3 class="text-success">Get in Touch</h3>
            <p><i class="bi bi-geo-alt"></i> Address: 123 Greenfield, Dodamarg</p>
            <p><i class="bi bi-telephone"></i> Phone: +91 9657109068</p>
            <p><i class="bi bi-envelope"></i> Email: contact@agriservice.com</p>
            <h5 class="text-success">Follow Us</h5>
            <div class="social-icons">
                <a href="#"><i class="bi bi-facebook"></i></a>
                <a href="#"><i class="bi bi-instagram"></i></a>
                <a href="#"><i class="bi bi-twitter"></i></a>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="col-lg-6">
            <div class="contact-form">
                <h4 class="text-success">Send Us a Message</h4>
                <form action="contact_process.php" method="POST" onsubmit="return validateForm()">
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" onkeyup="validateEmail()" required>
                        <div id="emailError" class="error-message"></div>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Your Message</label>
                        <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="mt-4 py-3 text-white text-center" style="background-color:#2d6a4f;">
    <p class="mb-1">&copy; 2025 Agriculture Service. All rights reserved.</p>
    <p class="mb-0">
        <a href="privacy.php" class="text-white text-decoration-none me-3">Privacy Policy</a>
        <a href="terms.php" class="text-white text-decoration-none me-3">Terms of Service</a>
    </p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
