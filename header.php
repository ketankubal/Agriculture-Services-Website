<?php if (isset($_SESSION['user_id'])): ?>
    <li class="nav-item">
        <a class="nav-link" href="profile.php">👤 Profile</a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-danger" href="logout.php">🚪 Logout</a>
    </li>
<?php else: ?>
    <li class="nav-item">
        <a class="nav-link" href="login.php">🔑 Login</a>
    </li>
<?php endif; ?>
