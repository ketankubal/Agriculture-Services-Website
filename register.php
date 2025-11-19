<?php 
session_start();
include 'includes/db_connect.php';

// Initialize messages
$error_message = "";
$success_message = "";

// Form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Validation
    if (empty($first_name) || empty($last_name) || empty($username) || empty($email) || empty($phone) || empty($password) || empty($confirm_password)) {
        $error_message = "⚠️ All fields are required!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match('/@gmail\.com$/', $email)) {
        $error_message = "⚠️ Email must be a valid Gmail address (e.g., user@gmail.com)!";
    } elseif (!preg_match('/^[0-9]{10}$/', $phone)) {
        $error_message = "⚠️ Invalid phone number! Must be 10 digits.";
    } elseif ($password !== $confirm_password) {
        $error_message = "⚠️ Passwords do not match!";
    } elseif (!preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password)) {
        $error_message = "⚠️ Password must be at least 8 characters long, include one uppercase letter, one number, and one special character!";
    } else {
        // Check if username already exists
        $query = "SELECT id FROM users WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error_message = "⚠️ Username already exists! Choose another.";
        } else {
            // Insert new user
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $insert_query = "INSERT INTO users (first_name, last_name, username, email, phone, password) VALUES (?, ?, ?, ?, ?, ?)";
            $insert_stmt = $conn->prepare($insert_query);
            $insert_stmt->bind_param("ssssss", $first_name, $last_name, $username, $email, $phone, $hashed_password);

            if ($insert_stmt->execute()) {
                $_SESSION['user_id'] = $insert_stmt->insert_id;
                $_SESSION['username'] = $username;

                // Redirect to login page after successful registration
                header("Location: login.php");
                exit();
            } else {
                $error_message = "⚠️ Registration failed: " . $insert_stmt->error;
            }
            $insert_stmt->close();
        }
        $stmt->close();
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Agriculture Project</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: url('background.jpg') no-repeat center center/cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .register-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 450px;
        }
        .form-control {
            border-radius: 8px;
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
        .error-message, .success-message {
            color: white;
            padding: 10px;
            border-radius: 5px;
            font-size: 16px;
            text-align: center;
            margin-bottom: 15px;
            font-weight: bold;
        }
        .error-message {
            background-color: #dc3545;
        }
        .success-message {
            background-color: #28a745;
        }
    </style>
    <script>
        function validateEmail() {
            var email = document.getElementById("email").value;
            var regex = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;

            if (!regex.test(email)) {
                alert("⚠️ Please enter a valid Gmail address (e.g., user@gmail.com).");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>

    <div class="register-container">
        <h2 class="text-center text-success mb-4">📝 Register</h2>

        <!-- Display messages -->
        <?php if (!empty($error_message)): ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php elseif (!empty($success_message)): ?>
            <div class="success-message"><?php echo $success_message; ?></div>
        <?php endif; ?>

        <form method="POST" action="register.php" onsubmit="return validateEmail()">
            <div class="mb-3">
                <input type="text" name="first_name" class="form-control" placeholder="First Name" required>
            </div>
            <div class="mb-3">
                <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
            </div>
            <div class="mb-3">
                <input type="text" name="username" class="form-control" placeholder="Username" required>
            </div>
            <div class="mb-3">
                <input type="email" id="email" name="email" class="form-control" placeholder="Email (must be @gmail.com)" required>
            </div>
            <div class="mb-3">
                <input type="text" name="phone" class="form-control" placeholder="Phone Number (10 digits)" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password (8+ chars, 1 uppercase, 1 number, 1 special char)" required>
            </div>
            <div class="mb-3">
                <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Register</button>
        </form>

        <div class="text-center mt-3">
            <a href="login.php" class="text-success">Already have an account? Login here</a>
        </div>
    </div>

</body>
</html>
