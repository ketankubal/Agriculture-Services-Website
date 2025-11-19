<?php
if(session_status()==PHP_SESSION_NONE){
    session_start();
}


// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css"> <!-- Add Bootstrap -->
    <link rel="stylesheet" href="../assets/css/admin_style.css"> <!-- Custom admin styles -->
</head>
<body>

<!-- Admin Navbar -->
<nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="dashboard.php">Admin Panel</a>
    <div>
        <a href="manage_products.php" class="btn btn-outline-light">Manage Products</a>
        <a href="manage_orders.php" class="btn btn-outline-light">Manage Orders</a>
        <a href="manage_users.php" class="btn btn-outline-light">Manage Users</a>
        <a href="categories.php" class="btn btn-outline-light">Manage Categories</a>
        
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
</nav>

<div class="container mt-4">
