<?php
session_start();
include("../config/db.php");

if ($_SESSION['role'] != 'vendor') {
    header("Location: ../auth/login.php");
}

$vendor_id = $_SESSION['vendor_id'];

if (isset($_POST['add'])) {

    $name = $_POST['name'];
    $price = $_POST['price'];

    $query = "INSERT INTO products (vendor_id, name, price)
              VALUES ('$vendor_id', '$name', '$price')";

    if ($conn->query($query)) {
        echo "Product Added Successfully";
    }
}
?>

<h2>Add Product</h2>

<form method="POST">
    <input type="text" name="name" placeholder="Product Name" required><br><br>
    <input type="number" name="price" placeholder="Price" required><br><br>

    <button name="add">Add Product</button>
</form>

<br>
<a href="dashboard.php">Back</a>