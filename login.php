<?php
session_start();
include 'includes/db_connect.php';

$error = ""; // Initialize error message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $identifier = trim($_POST['identifier']); // Accepts both username or email
    $password = trim($_POST['password']);

    // ✅ Secure Query: Check for user by username OR email
    $query = "SELECT id, username, email, password FROM users WHERE username = ? OR email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $identifier, $identifier);
    $stmt->execute();
    $result = $stmt->get_result();

    // ✅ Fetch User Data
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // ✅ Verify Password
        if (password_verify($password, $row['password'])) {
            // ✅ Store User Info in Session
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];

            // ✅ Redirect to Home Page
            $_SESSION['success_message'] = "🎉 Welcome back, " . $row['username'] . "!";
            header("Location: index.php");
            exit();
        } else {
            $error = "❌ Invalid Password!";
        }
    } else {
        $error = "❌ User not found!";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Agriculture Project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Background Styling */
        body {
            background: url('images/login_background.jpg') no-repeat center center/cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Login Box Styling */
        .login-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        /* Input Fields */
        .form-control {
            border-radius: 8px;
            border: 1px solid #28a745;
            padding: 10px;
            font-size: 16px;
        }

        /* Buttons */
        .btn-success {
            background-color: #28a745;
            border: none;
            padding: 10px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        /* Error Message Styling */
        .alert-danger {
            font-size: 14px;
            padding: 8px;
            border-radius: 5px;
        }

        /* Register Link */
        .register-link {
            color: #28a745;
            font-weight: bold;
            text-decoration: none;
        }

        .register-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h3 class="mb-3">🌱 Agriculture Project</h3>
    <h5 class="text-primary">Login</h5>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger py-2" role="alert">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <input type="text" name="identifier" class="form-control" placeholder="Username or Email" required>
        </div>
        <div class="mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>
        <button type="submit" class="btn btn-success w-100">Login</button>
    </form>

    <p class="mt-3">
        Don't have an account? <a href="register.php" class="register-link">Register here</a>
    </p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
