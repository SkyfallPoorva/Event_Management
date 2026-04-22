<?php
session_start();
include("../config/db.php");

if ($_SESSION['role'] != 'user') {
    header("Location: ../auth/login.php");
}
?>

<h2>Vendors</h2>

<?php
$query = "SELECT * FROM vendors";
$result = $conn->query($query);

while ($row = $result->fetch_assoc()) {
    echo "
    <div>
        <h4>{$row['name']}</h4>
        <p>{$row['category']}</p>
        <a href='products.php?vendor_id={$row['id']}'>Shop Item</a>
    </div>
    <hr>
    ";
}
?>

<a href="dashboard.php">Back</a>