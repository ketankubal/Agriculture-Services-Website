<?php 
session_start();
include 'includes/db_connect.php';

// Check if OTP was generated
if (!isset($_SESSION['otp'])) {
    echo "<script>alert('⚠️ No OTP generated! Please register again.'); window.location.href='register.php';</script>";
    exit();
}

// Handle OTP submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $entered_otp = trim($_POST['otp']);

    // Check if OTP matches
    if ($entered_otp == $_SESSION['otp']) {
        // Get stored user data
        $user_data = $_SESSION['register_data'];
        
        // Hash password
        $hashed_password = password_hash($user_data['password'], PASSWORD_DEFAULT);

        // Insert user into database
        $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, username, email, phone, password) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", 
            $user_data['first_name'], 
            $user_data['last_name'], 
            $user_data['username'], 
            $user_data['email'], 
            $user_data['phone'], 
            $hashed_password
        );

        if ($stmt->execute()) {
            unset($_SESSION['otp'], $_SESSION['otp_time'], $_SESSION['register_data']); // Clear session data
            echo "<script>alert('🎉 Registration successful!'); window.location.href='login.php';</script>";
            exit();
        } else {
            echo "<script>alert('⚠️ Registration failed! Try again.'); window.location.href='register.php';</script>";
            exit();
        }
    } else {
        echo "<script>alert('⚠️ Invalid OTP! Try again.'); window.location.href='otp_verification.php';</script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification | Agriculture Project</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: url('background.jpg') no-repeat center center/cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .otp-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 450px;
        }
        .btn-primary {
            background-color: #28a745;
            border: none;
            padding: 10px;
            border-radius: 8px;
            font-size: 16px;
        }
        .btn-primary:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

    <div class="otp-container">
        <h2 class="text-center text-success mb-4">🔑 Enter OTP</h2>

        <form method="POST" action="otp_verification.php">
            <div class="mb-3">
                <input type="text" name="otp" class="form-control" placeholder="Enter OTP" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Verify OTP</button>
        </form>
    </div>

</body>
</html>
