<?php
session_start();
include 'includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $payment_method = $_POST['payment_method'];
    $total_amount = $_POST['total_amount'];

    // ✅ Store Order in Database (You need to create an 'orders' table)
    $query = "INSERT INTO orders (full_name, email, phone, address, payment_method, total_amount, status) 
              VALUES ('$full_name', '$email', '$phone', '$address', '$payment_method', '$total_amount', 'Pending')";
    mysqli_query($conn, $query);
    
    $_SESSION['order_id'] = mysqli_insert_id($conn);

    if ($payment_method === 'UPI') {
        header("Location: upi_payment.php");
        exit();
    } else {
        header("Location: order_success.php");
        exit();
    }
}
?>
