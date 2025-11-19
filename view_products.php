<?php
session_start();

include 'navbar.php'; // Include the navbar file
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
}

$conn = new mysqli('localhost', 'root', '', 'agriculture_service');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM products";
$result = $conn->query($sql);

echo "<h1>Manage Products</h1>";
echo "<table><tr><th>Product Name</th><th>Description</th><th>Price</th><th>Actions</th></tr>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['name'] . "</td>
                <td>" . $row['description'] . "</td>
                <td>" . $row['price'] . "</td>
                <td><a href='edit_product.php?id=" . $row['id'] . "'>Edit</a> | 
                <a href='delete_product.php?id=" . $row['id'] . "'>Delete</a></td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='4'>No products found</td></tr>";
}

echo "</table>";

$conn->close();
?>
