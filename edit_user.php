<?php 
session_start();
include '../includes/db_connect.php'; // Ensure the database connection is correct

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

// Check if user_id is provided
if (!isset($_GET['user_id']) || empty($_GET['user_id'])) {
    die("❌ Error: User ID is missing!");
}

$user_id = intval($_GET['user_id']); // Sanitize input

// Fetch user details
$query = "SELECT id, username, email FROM users WHERE id = ?";
$stmt = $conn->prepare($query);

if (!$stmt) {
    die("❌ SQL Prepare Error: " . $conn->error);
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("❌ Error: No user found with ID $user_id");
}

$user = $result->fetch_assoc();
$stmt->close();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);

    // Validate inputs
    if (empty($username) || empty($email)) {
        $_SESSION['message'] = "❌ All fields are required!";
        header("Location: edit_user.php?user_id=$user_id");
        exit;
    }

    // Update user details
    $update_query = "UPDATE users SET username = ?, email = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_query);

    if (!$update_stmt) {
        die("❌ SQL Prepare Error: " . $conn->error);
    }

    $update_stmt->bind_param("ssi", $username, $email, $user_id);
    
    if ($update_stmt->execute()) {
        $_SESSION['message'] = "✅ User updated successfully!";
        header("Location: manage_users.php");
        exit;
    } else {
        $_SESSION['message'] = "❌ Error updating user: " . $conn->error;
    }

    $update_stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User | Admin Panel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">Edit User</h2>

    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-info">
            <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="mb-3">
            <label for="username" class="form-label">Username:</label>
            <input type="text" name="username" id="username" class="form-control" value="<?php echo htmlspecialchars($user['username']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" name="email" id="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update User</button>
        <a href="manage_users.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
