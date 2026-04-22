<?php
session_start();
include("../config/db.php");

if ($_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
}
?>

<h2>Manage Users</h2>

<a href="add_user.php">Add User</a>
<br><br>

<?php
$result = $conn->query("SELECT * FROM users");

while ($row = $result->fetch_assoc()) {
    echo "
    <div style='border:1px solid black; margin:10px; padding:10px;'>
        <p>Name: {$row['name']}</p>
        <p>Email: {$row['email']}</p>
        
        <a href='edit_user.php?id={$row['id']}'>Edit</a> |
        <a href='delete_user.php?id={$row['id']}'>Delete</a>
    </div>
    ";
}
?>