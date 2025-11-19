<?php
// Start session only if it's not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if username is set in session
$username = isset($_SESSION['username']) ? $_SESSION['username'] : "Guest";
?>

<nav class="navbar navbar-expand-lg" style="background: linear-gradient(90deg, #28a745, #218838); padding: 12px 0;">
    <div class="container-fluid d-flex justify-content-between align-items-center">  <!-- ✅ Full width navbar -->
        
        <!-- ✅ Logo & Brand Name -->
        <a class="navbar-brand d-flex align-items-center text-white fw-bold" href="index.php">
            <img src="images/logo.png" alt="Logo" style="height: 45px; margin-right: 10px;">
            Agriculture
        </a>

        <!-- Navbar Toggle (For Mobile) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- ✅ Navbar Links in One Line -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav d-flex align-items-center gap-3">  <!-- ✅ Ensures items stay in one line -->
                <li class="nav-item"><a class="nav-link text-white" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="products.php">Products</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="services.php">Services</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="about.php">About Us</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="my_account.php">My Messages</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="contact.php">Contact Us</a></li>
            </ul>
        </div>

        <!-- ✅ Search Bar + Profile + Cart + Logout in One Line -->
        <div class="d-flex align-items-center gap-3">
            <!-- Search Bar -->
            <form class="d-flex" action="products.php" method="GET" style="max-width: 250px;">
                <input class="form-control me-2 rounded-pill" type="search" name="search" placeholder="Search products..."
                    value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>" required>
                <button class="btn btn-light rounded-circle" type="submit">🔍</button>
            </form>

            <!-- User Profile -->
            <a class="nav-link text-white fw-bold d-flex align-items-center" href="account.php">
                👤 <?= htmlspecialchars($username); ?>
            </a>

            <!-- Cart Icon -->
            <a class="nav-link text-white fw-bold d-flex align-items-center" href="cart.php">
                🛒 Cart
            </a>

            <!-- ✅ Logout/Login Button -->
            <?php if (isset($_SESSION['user_id'])) { ?>
                <a class="btn btn-danger" href="logout.php">Logout</a>
            <?php } else { ?>
                <a class="btn btn-primary" href="login.php">Login</a>
            <?php } ?>
        </div>
    </div>
</nav>
