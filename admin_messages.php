<?php
session_start();
include '../includes/db_connect.php';
include_once __DIR__ . '/admin_header.php';

// Check if the admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch all messages from the contact_messages table
$query = "SELECT * FROM contact_messages ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Database Error: " . mysqli_error($conn)); // Debugging database errors
}

// Handle reply submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reply']) && isset($_POST['message_id'])) {
    $message_id = mysqli_real_escape_string($conn, $_POST['message_id']);
    $reply = mysqli_real_escape_string($conn, $_POST['reply']);

    // Insert reply into database
    $updateQuery = "UPDATE contact_messages SET reply='$reply', replied_at=NOW() WHERE id='$message_id'";
    if (mysqli_query($conn, $updateQuery)) {
        echo "<script>alert('Reply sent successfully!'); window.location.href='admin_messages.php';</script>";
    } else {
        echo "<script>alert('Error sending reply: " . mysqli_error($conn) . "');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Messages | AgriService</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    
<div class="container mt-5">
    <h2 class="text-success">📩 User Messages</h2>

    <table class="table table-bordered table-striped mt-3">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Reply</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['message']) ?></td>
                    <td>
                        <?php if (!empty($row['reply'])): ?>
                            <span class="text-success"><?= htmlspecialchars($row['reply']) ?></span>
                        <?php else: ?>
                            <span class="text-danger">No reply yet</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <!-- Reply Form -->
                        <form action="admin_messages.php" method="POST">
                            <input type="hidden" name="message_id" value="<?= $row['id'] ?>">
                            <textarea name="reply" class="form-control mb-2" required placeholder="Type your reply here..."></textarea>
                            <button type="submit" class="btn btn-success btn-sm">Send Reply</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
