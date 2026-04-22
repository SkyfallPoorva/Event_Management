<?php
session_start();
include("../config/db.php");

if ($_SESSION['role'] != 'vendor') {
    header("Location: ../auth/login.php");
}

if (isset($_POST['update'])) {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    $conn->query("UPDATE orders SET status='$status' WHERE id='$order_id'");
}
?>

<h2>Update Order Status</h2>

<form method="POST">

<input type="number" name="order_id" placeholder="Order ID" required><br><br>

<input type="radio" name="status" value="Received" checked> Received<br>
<input type="radio" name="status" value="Ready for Shipping"> Ready for Shipping<br>
<input type="radio" name="status" value="Out for Delivery"> Out for Delivery<br><br>

<button name="update">Update</button>

</form>

<a href="dashboard.php">Back</a>