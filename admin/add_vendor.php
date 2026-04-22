<?php
include("../config/db.php");

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $category = $_POST['category'];

    $conn->query("INSERT INTO vendors (name, email, password, category)
                  VALUES ('$name', '$email', '$password', '$category')");

    header("Location: manage_vendors.php");
}
?>

<h2>Add Vendor</h2>

<form method="POST">
    <input type="text" name="name" placeholder="Name"><br><br>
    <input type="email" name="email" placeholder="Email"><br><br>
    <input type="text" name="password" placeholder="Password"><br><br>
    <input type="text" name="category" placeholder="Category"><br><br>

    <button name="submit">Add Vendor</button>
</form>