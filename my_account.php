<?php
session_start();
include 'includes/db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch the user's email
$user_query = "SELECT email FROM users WHERE id='$user_id'";
$user_result = mysqli_query($conn, $user_query);

if ($user_result) {
    $user_row = mysqli_fetch_assoc($user_result);
    $user_email = $user_row['email'];
} else {
    die("Error fetching user email: " . mysqli_error($conn));
}

// Fetch only messages where admin has replied
$query = "SELECT message, reply, replied_at FROM contact_messages WHERE email='$user_email' AND reply IS NOT NULL ORDER BY replied_at DESC";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error fetching messages: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account | AgriService</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        body {
            background: #f8f9fa;
        }

        .account-container {
            max-width: 800px;
            margin: 40px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }

        .table-hover tbody tr:hover {
            background: #e9f5e9;
        }

        .message-box {
            background: #e8f5e9;
            padding: 10px;
            border-radius: 5px;
        }

        .reply-box {
            background: #f1f8ff;
            padding: 10px;
            border-radius: 5px;
        }

        .alert-custom {
            font-size: 18px;
            font-weight: bold;
            background: #ffeb3b;
            color: black;
        }

        .header-icon {
            font-size: 1.5rem;
            color: #2d6a4f;
        }

        .logout-btn {
            background: #dc3545;
            border: none;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            transition: 0.3s;
        }

        .logout-btn:hover {
            background: #b02a37;
        }
    </style>
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container">
    <div class="account-container">
        <h2 class="text-center text-success fw-bold">
            <i class="bi bi-person-circle header-icon"></i> My Messages
        </h2>
        <p class="text-center text-muted">View admin responses to your queries.</p>

        <?php if (mysqli_num_rows($result) > 0) { ?>
            <table class="table table-hover table-bordered mt-4">
                <thead class="table-success">
                    <tr>
                        <th>Your Message</th>
                        <th>Admin Reply</th>
                        <th>Replied At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td>
                            <div class="message-box">
                                <i class="bi bi-chat-left-text"></i> <?= htmlspecialchars($row['message']); ?>
                            </div>
                        </td>
                        <td>
                            <div class="reply-box">
                                <i class="bi bi-reply-fill"></i> <?= htmlspecialchars($row['reply']); ?>
                            </div>
                        </td>
                        <td>
                            <i class="bi bi-calendar-check"></i> <?= date("d M Y, h:i A", strtotime($row['replied_at'])); ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p class="alert alert-custom text-center">
                <i class="bi bi-exclamation-circle"></i> No replies from admin yet.
            </p>
        <?php } ?>

        <div class="text-center mt-4">
            <a href="logout.php" class="logout-btn">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
