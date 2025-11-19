<?php
session_start();
include 'includes/db_connect.php';

if (!isset($_SESSION['pending_user'])) {
    header("Location: register.php");
    exit();
}

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $entered_otp = trim($_POST['otp']);
    
    if ($entered_otp == $_SESSION['otp']) {
        // Retrieve user data from session
        $user = $_SESSION['pending_user'];
        
        // Insert user into the database
        $hashed_password = password_hash($user['password'], PASSWORD_DEFAULT);
        $query = "INSERT INTO users (first_name, last_name, username, email, phone, password) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssss", $user['first_name'], $user['last_name'], $user['username'], $user['email'], $user['phone'], $hashed_password);
        
        if ($stmt->execute()) {
            $_SESSION['user_id'] = $stmt->insert_id;
            $_SESSION['username'] = $user['username'];
            
            unset($_SESSION['pending_user']); // Remove pending user data
            unset($_SESSION['otp']); // Remove OTP session
            
            echo "<script>alert('🎉 Registration successful! You can now login.'); window.location.href='login.php';</script>";
            exit();
        } else {
            $error_message = "⚠️ Registration failed. Please try again!";
        }
    } else {
        $error_message = "⚠️ Invalid OTP! Please enter the correct code.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP | Agriculture Project</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-4 shadow">
                    <h3 class="text-center text-success">🔑 Enter OTP</h3>
                    <?php if (!empty($error_message)): ?>
                        <div class="alert alert-danger"> <?php echo $error_message; ?> </div>
                    <?php endif; ?>
                    <form method="POST">
                        <div class="mb-3">
                            <input type="text" name="otp" class="form-control" placeholder="Enter 6-digit OTP" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Verify OTP</button>
                    </form>
                    <div class="text-center mt-3">
                        <a href="register.php" class="text-danger">🔄 Resend OTP</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
