<?php
include("../config/db.php");

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $conn->query("INSERT INTO users (name, email, password) 
                  VALUES ('$name', '$email', '$password')");

    header("Location: manage_users.php");
}
?>

<h2>Add User</h2>

<form method="POST">
    <input type="text" name="name" placeholder="Name" required><br><br>
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="text" name="password" placeholder="Password" required><br><br>
    
    <button name="submit">Add User</button>
</form>