<?php 
session_start();
include 'navbar.php'; // Include navbar
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy | Agriculture Project</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        /* Page Styling */
        .privacy-container {
            max-width: 900px;
            margin: auto;
            padding: 40px 20px;
        }
        h2 {
            color: #218838;
        }
        p {
            text-align: justify;
            font-size: 1.1rem;
        }
        ul {
            list-style-type: square;
        }
        .footer {
            background: #218838;
            color: white;
            text-align: center;
            padding: 15px;
            margin-top: 30px;
        }
        .footer a {
            color: #d4edda;
            text-decoration: none;
            font-weight: bold;
        }
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<!-- Privacy Policy Content -->
<div class="container privacy-container">
    <h2 class="text-center mb-4">Privacy Policy</h2>
    
    <p>At <strong>Agriculture Project</strong>, we value your privacy and are committed to protecting your personal data. This Privacy Policy explains how we collect, use, and safeguard your information.</p>

    <h4>1. Information We Collect</h4>
    <p>We may collect the following types of information when you use our website:</p>
    <ul>
        <li><strong>Personal Information:</strong> Name, email, phone number, and address when you create an account or place an order.</li>
        <li><strong>Payment Details:</strong> We do not store payment information. Payments are securely processed by third-party providers.</li>
        <li><strong>Usage Data:</strong> IP address, browser type, and browsing behavior to improve website experience.</li>
    </ul>

    <h4>2. How We Use Your Information</h4>
    <p>We use your information for the following purposes:</p>
    <ul>
        <li>Processing orders and delivering products.</li>
        <li>Providing customer support.</li>
        <li>Improving website functionality and user experience.</li>
        <li>Sending updates, promotions, and important notifications.</li>
    </ul>

    <h4>3. Data Protection & Security</h4>
    <p>We implement strong security measures to protect your personal information. However, no method of transmission over the internet is 100% secure.</p>

    <h4>4. Cookies & Tracking Technologies</h4>
    <p>We use cookies to enhance user experience, analyze site traffic, and personalize content. You can disable cookies in your browser settings.</p>

    <h4>5. Your Rights</h4>
    <p>You have the right to:</p>
    <ul>
        <li>Access, update, or delete your personal information.</li>
        <li>Opt-out of marketing communications.</li>
        <li>Request a copy of the data we store about you.</li>
    </ul>

    <h4>6. Third-Party Links</h4>
    <p>Our website may contain links to third-party websites. We are not responsible for their privacy policies.</p>

    <h4>7. Updates to This Policy</h4>
    <p>We may update this policy periodically. Changes will be posted on this page with an updated date.</p>

    <h4>8. Contact Us</h4>
    <p>If you have any questions about this Privacy Policy, please contact us at <a href="contact.php">Contact Us</a>.</p>
</div>

<!-- Footer -->
<footer class="footer">
    <p>© 2025 Agriculture Project. All rights reserved.</p>
    <p>
        <a href="index.php">Home</a> | 
        <a href="contact.php">Contact Us</a>
    </p>
</footer>

</body>
</html>
