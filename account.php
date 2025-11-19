<?php
session_start();
include 'includes/db_connect.php';

include 'navbar.php';
// Redirect to login page if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user details securely
$sql = "SELECT username, email, phone, address, profile_image FROM users WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);
    } else {
        $user_data = [
            'username' => 'Unknown',
            'email' => 'Not Available',
            'phone' => 'Not Available',
            'address' => 'Not Available',
            'profile_image' => ''
        ];
    }
    
    mysqli_stmt_close($stmt);
} else {
    die("SQL Error: " . mysqli_error($conn));
}

// Set profile image path (default if not uploaded)
$profile_image = !empty($user_data['profile_image']) ? 'uploads/' . htmlspecialchars($user_data['profile_image']) : 'images/default-profile.png';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account | AgriService</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #28a745, #218838);
            color: #fff;
            font-family: Arial, sans-serif;
        }
        
        .account-container {
            max-width: 500px;
            background: white;
            padding: 30px;
            margin: 60px auto;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
            color: black;
        }
        .profile-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #28a745;
            margin-bottom: 15px;
        }
        .btn-custom {
            width: 100%;
            margin: 5px 0;
        }
    </style>
</head>
<body>


          
             

<!-- Include FontAwesome for Icons -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>


<div class="container">
    <div class="account-container">
        <!-- Display Profile Image -->
        <img src="<?php echo $profile_image; ?>" class="profile-img" alt="Profile Image">
        
        <h3><?php echo htmlspecialchars($user_data['username']); ?></h3>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user_data['email']); ?></p>
        <p><strong>Phone:</strong> <?php echo htmlspecialchars($user_data['phone']); ?></p>
        <p><strong>Address:</strong> <?php echo htmlspecialchars($user_data['address']); ?></p>
        
        <!-- Buttons -->
        <a href="edit_account.php" class="btn btn-primary btn-custom">Edit Profile</a>
        <a href="my_orders.php" class="btn btn-secondary btn-custom">My Orders</a>
        <a href="logout.php" class="btn btn-danger btn-custom">Logout</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
