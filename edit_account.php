<?php
session_start();
include 'includes/db_connect.php';
include 'navbar.php'; // Include the navbar file

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user details
$sql = "SELECT username, email, phone, address, profile_image FROM users WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user_data = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

// Profile image path
$profile_image = !empty($user_data['profile_image']) ? 'uploads/' . $user_data['profile_image'] : 'images/default-profile.png';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    
    // Profile image upload
    if (!empty($_FILES["profile_image"]["name"])) {
        $target_dir = "uploads/";
        $imageFileType = strtolower(pathinfo($_FILES["profile_image"]["name"], PATHINFO_EXTENSION));
        $new_file_name = "profile_" . $user_id . "." . $imageFileType;
        $target_file = $target_dir . $new_file_name;
        
        // Validate image
        if (in_array($imageFileType, ['jpg', 'jpeg', 'png'])) {
            if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
                $profile_image = $new_file_name;
            }
        }
    } else {
        $profile_image = $user_data['profile_image']; // Keep old image
    }

    // Update user details
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $sql = "UPDATE users SET username=?, email=?, phone=?, address=?, profile_image=?, password=? WHERE id=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssssi", $username, $email, $phone, $address, $profile_image, $password, $user_id);
    } else {
        $sql = "UPDATE users SET username=?, email=?, phone=?, address=?, profile_image=? WHERE id=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssssi", $username, $email, $phone, $address, $profile_image, $user_id);
    }

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success_msg'] = "Profile updated successfully!";
        header("Location: edit_account.php");
        exit();
    } else {
        $error_msg = "Error updating profile: " . mysqli_error($conn);
    }
    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile | AgriService</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
        }
        .account-container {
            max-width: 500px;
            background: white;
            padding: 30px;
            margin: 50px auto;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .profile-img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
            border: 3px solid #28a745;
        }
        .btn-save {
            background: linear-gradient(90deg, #28a745, #218838);
            border: none;
        }
        .btn-save:hover {
            background: linear-gradient(90deg, #218838, #1e7e34);
        }
    </style>
</head>
<body>

<div class="container">
    <div class="account-container text-center">
        <h2 class="mb-3">Edit Profile</h2>
        <form method="post" enctype="multipart/form-data">
            <!-- Profile Image -->
            <div class="mb-3">
                <img src="<?php echo $profile_image; ?>" class="profile-img" id="profilePreview" alt="Profile Image">
                <input type="file" class="form-control mt-2" name="profile_image" id="profileImage" accept="image/png, image/jpeg, image/jpg">
            </div>

            <?php if (!empty($_SESSION['success_msg'])) { ?>
                <div class="alert alert-success"><?php echo $_SESSION['success_msg']; unset($_SESSION['success_msg']); ?></div>
            <?php } elseif (!empty($error_msg)) { ?>
                <div class="alert alert-danger"><?php echo $error_msg; ?></div>
            <?php } ?>

            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" class="form-control" name="username" value="<?php echo htmlspecialchars($user_data['username']); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($user_data['email']); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="text" class="form-control" name="phone" value="<?php echo htmlspecialchars($user_data['phone']); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Address</label>
                <textarea class="form-control" name="address" required><?php echo htmlspecialchars($user_data['address']); ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">New Password (Optional)</label>
                <input type="password" class="form-control" name="password" placeholder="Leave blank to keep current password">
            </div>
            <button type="submit" class="btn btn-save w-100 text-white">Save Changes</button>
        </form>

        <a href="account.php" class="btn btn-secondary mt-3 w-100">Back to Account</a>
    </div>
</div>

<script>
    document.getElementById("profileImage").addEventListener("change", function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById("profilePreview").src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
