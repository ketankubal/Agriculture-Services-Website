<?php
session_start();
unset($_SESSION['cart']); // Clear cart
header("Location: cart.php");
exit();
?>
