<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'user') {
    header("Location: ../auth/login.php");
    exit();
}

$id = $_GET['id'];

// Update order status
$conn->query("UPDATE orders SET status='Cancelled' WHERE id='$id'");

header("Location: order_status.php");
?>