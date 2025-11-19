<?php
session_start();
include 'includes/db_connect.php';

// Check if form data was received
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $postData = $_POST;
} else {
    die("<h2 style='color:red; text-align:center;'>⚠️ No form data received.</h2>");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to right, #ff9a9e, #fad0c4);
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        h2 {
            color: #d9534f;
        }
        .list-group-item {
            font-size: 18px;
            font-weight: bold;
        }
        .btn {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center">🛍 Order Details</h2>
    <ul class="list-group">
        <?php foreach ($postData as $key => $value): ?>
            <li class="list-group-item"><strong><?php echo ucfirst(str_replace('_', ' ', $key)); ?>:</strong> <?php echo htmlspecialchars($value, ENT_QUOTES, 'UTF-8'); ?></li>
        <?php endforeach; ?>
    </ul>

    <a href="checkout.php" class="btn btn-warning w-100 mt-3">🔙 Go Back to Checkout</a>
</div>

</body>
</html>
