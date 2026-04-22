<?php
include("../config/db.php");

$id = $_GET['id'];

$result = $conn->query("SELECT * FROM users WHERE id=$id");
$user = $result->fetch_assoc();

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $conn->query("UPDATE users 
                  SET name='$name', email='$email' 
                  WHERE id=$id");

    header("Location: manage_users.php");
}
?>

<h2>Edit User</h2>

<form method="POST">
    <input type="text" name="name" value="<?= $user['name'] ?>"><br><br>
    <input type="email" name="email" value="<?= $user['email'] ?>"><br><br>
    
    <button name="update">Update</button>
</form>