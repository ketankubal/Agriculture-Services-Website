<?php  
session_start();
include 'navbar.php'; // Include navbar for consistency
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms and Conditions</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            background-color: #f9f9f9;
            font-family: Arial, sans-serif;
        }
        .terms-header {
            background: linear-gradient(to right, #28a745, #218838);
            color: white;
            padding: 40px 20px;
            text-align: center;
        }
        .terms-header h1 {
            font-size: 2.5rem;
            font-weight: bold;
        }
        .terms-container {
            padding: 40px 20px;
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin: 20px auto;
            border-radius: 10px;
        }
        .terms-container h2 {
            font-size: 1.8rem;
            font-weight: bold;
            color: #28a745;
        }
        .terms-container p {
            line-height: 1.6;
            font-size: 1rem;
        }
        footer {
            background: #218838;
            color: white;
            padding: 20px 10px;
            text-align: center;
            font-size: 0.9rem;
        }
        footer a {
            color: #d4edda;
            text-decoration: none;
        }
        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<!-- Header Section -->
<div class="terms-header">
    <h1>Terms and Conditions</h1>
    <p>Please read these terms carefully before using our services.</p>
</div>

<!-- Terms and Conditions Content -->
<div class="container terms-container">
    <h2>1. Introduction</h2>
    <p>Welcome to our agriculture eCommerce platform. By using our website, you agree to comply with and be bound by the following terms and conditions.</p>

    <h2>2. Eligibility</h2>
    <p>You must be at least 18 years old to use our services. By registering, you confirm that you meet this age requirement.</p>

    <h2>3. User Responsibilities</h2>
    <p>
        - Ensure that all the information you provide is accurate and up-to-date.<br>
        - Do not use our platform for illegal activities or to violate any laws.<br>
        - Keep your account credentials confidential. We are not responsible for unauthorized access to your account.
    </p>

    <h2>4. Payments</h2>
    <p>
        - All payments must be made through the payment methods provided on our platform.<br>
        - We do not store sensitive payment information such as card numbers or UPI details.
    </p>

    <h2>5. Refund Policy</h2>
    <p>
        - Refunds will be processed in accordance with our refund policy.<br>
        - If you have any issues, please contact our support team for assistance.
    </p>

    <h2>6. Product Availability</h2>
    <p>
        - We strive to keep all products available; however, availability is subject to change without prior notice.<br>
        - In case a product is out of stock, we will notify you promptly and offer alternatives if possible.
    </p>

    <h2>7. Limitation of Liability</h2>
    <p>We are not liable for any direct, indirect, or consequential damages resulting from the use of our platform or products.</p>

    <h2>8. Changes to Terms</h2>
    <p>We reserve the right to update these terms at any time without prior notice. Changes will be effective immediately upon posting on the website.</p>

    <h2>9. Contact Us</h2>
    <p>If you have any questions or concerns about these terms, please <a href="contact.php">contact us</a>.</p>
</div>

<!-- Footer -->
<footer>
    <p>© 2025 Agriculture Project. All rights reserved.</p>
    <p>
        <a href="index.php">Home</a> |
        <a href="privacy.php">Privacy Policy</a> |
        <a href="contact.php">Contact Us</a>
    </p>
</footer>

</body>
</html>
