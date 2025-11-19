<?php
session_start();
include 'includes/db_connect.php';
include 'navbar.php';

if (isset($_GET['remove'])) {
    $remove_id = intval($_GET['remove']);
    unset($_SESSION['cart'][$remove_id]);
    $_SESSION['cart_message'] = "";
    header("Location: cart.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_quantity'])) {
    $product_id = intval($_POST['product_id']);
    $new_quantity = intval($_POST['quantity']);

    if ($new_quantity > 0) {
        $_SESSION['cart'][$product_id]['quantity'] = $new_quantity;
    } else {
        unset($_SESSION['cart'][$product_id]);
    }
    $_SESSION['cart_message'] = "✅ Cart updated.";
    header("Location: cart.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">🛒 Your Shopping Cart</h2>

    <?php if (isset($_SESSION['cart_message'])) { ?>
        <div class="alert alert-success text-center"> <?php echo $_SESSION['cart_message']; ?> </div>
        <?php unset($_SESSION['cart_message']); ?>
    <?php } ?>

    <?php if (!empty($_SESSION['cart'])) { ?>
        <div class="table-responsive">
            <table class="table table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Product</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total = 0;
                    foreach ($_SESSION['cart'] as $id => $product) {
                        $subtotal = $product['price'] * $product['quantity'];
                        $total += $subtotal;
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($product['name']); ?></td>
                        <td><img src="uploads/<?php echo htmlspecialchars($product['image']); ?>" width="80" class="img-thumbnail"></td>
                        <td>₹<?php echo number_format($product['price'], 2); ?></td>
                        <td>
                            <form method="POST" class="d-flex justify-content-center align-items-center">
                                <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                                <input type="number" name="quantity" class="form-control w-50 me-2" value="<?php echo $product['quantity']; ?>" min="1">
                                <button type="submit" name="update_quantity" class="btn btn-primary btn-sm">Update</button>
                            </form>
                        </td>
                        <td>₹<?php echo number_format($subtotal, 2); ?></td>
                        <td><a href="cart.php?remove=<?php echo $id; ?>" class="btn btn-danger btn-sm">Remove</a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="text-end">
            <h4>Total: ₹<?php echo number_format($total, 2); ?></h4>
            <a href="checkout.php" class="btn btn-success">Proceed to Checkout</a>
        </div>
    <?php } else { ?>
        <div class="alert alert-warning text-center">Your cart is empty. <a href="products.php" class="alert-link">Shop now</a></div>
    <?php } ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>