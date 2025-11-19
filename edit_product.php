<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
}

$id = $_GET['id'];

$conn = new mysqli('localhost', 'root', '', 'agriculture_service');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM products WHERE id=$id";
$result = $conn->query($sql);
$product = $result->fetch_assoc();

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    if ($_FILES['image']['name']) {
        $image = $_FILES['image']['name'];
        $target = "images/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
    } else {
        $image = $product['image']; // Keep existing image if not updated
    }

    $sql = "UPDATE products SET name='$name', description='$description', price='$price', image='$image' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Product updated successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>

<!-- Edit Product Form -->
<form method="post" action="edit_product.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
    <input type="text" name="name" value="<?php echo $product['name']; ?>" required>
    <textarea name="description"><?php echo $product['description']; ?></textarea>
    <input type="number" name="price" value="<?php echo $product['price']; ?>" required>
    <input type="file" name="image">
    <button type="submit" name="submit">Update Product</button>
</form>
