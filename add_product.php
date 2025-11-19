<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity']; // Get quantity input
    $image = $_FILES['image']['name'];
    $target = "images/" . basename($image);

    // Connect to database
    $conn = new mysqli('localhost', 'root', '', 'agriculture_service');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert product into database with quantity
    $sql = "INSERT INTO products (name, description, price, quantity, image) 
            VALUES ('$name', '$description', '$price', '$quantity', '$image')";

    if ($conn->query($sql) === TRUE) {
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        echo "✅ Product added successfully!";
    } else {
        echo "❌ Error: " . $conn->error;
    }

    $conn->close();
}
?>

<!-- Add Product Form -->
<form method="post" action="add_product.php" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Product Name" required>
    <textarea name="description" placeholder="Description" required></textarea>
    <input type="number" name="price" placeholder="Price" required>
    <input type="number" name="quantity" placeholder="Quantity" min="1" required> <!-- Quantity Input -->
    <input type="file" name="image" required>
    <button type="submit" name="submit">Add Product</button>
</form>
