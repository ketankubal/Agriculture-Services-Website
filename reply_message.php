<?php
include 'includes/db_connect.php';


// Check if message ID is passed
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Error: Message ID is missing.");
}

$message_id = intval($_GET['id']); // Convert to integer for security

// Fetch the message from database
$query = "SELECT * FROM contact_messages WHERE id = $message_id";
$result = mysqli_query($conn, $query);

// Debugging: Check if the query runs successfully
if (!$result) {
    die("Database Error: " . mysqli_error($conn));
}

// Fetch the message
$message = mysqli_fetch_assoc($result);
if (!$message) {
    die("Error: Message not found.");
}

// Check if form is submitted (Admin replying to user)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $reply_message = mysqli_real_escape_string($conn, $_POST['reply_message']);
    $user_email = $message['email']; // Get user email from fetched message

    // Insert reply into the database
    $insert_query = "INSERT INTO admin_replies (message_id, reply_message, replied_at) VALUES ('$message_id', '$reply_message', NOW())";

    if (mysqli_query($conn, $insert_query)) {
        echo "<script>alert('Reply sent successfully!'); window.location.href='messages.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reply to Message</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-success">Reply to User Message</h2>
    
    <div class="card p-3">
        <h5>User: <?= htmlspecialchars($message['name']) ?></h5>
        <p>Email: <?= htmlspecialchars($message['email']) ?></p>
        <p><strong>Message:</strong> <?= nl2br(htmlspecialchars($message['message'])) ?></p>
    </div>

    <form method="POST" class="mt-3">
        <div class="mb-3">
            <label for="reply_message" class="form-label">Your Reply</label>
            <textarea class="form-control" id="reply_message" name="reply_message" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Send Reply</button>
        <a href="messages.php" class="btn btn-secondary">Back</a>
    </form>
</div>

</body>
</html>
