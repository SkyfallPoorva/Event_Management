<?php
session_start();
include("../config/db.php");

// Admin check
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit();
}

$id = $_GET['id'];

$conn->query("DELETE FROM membership WHERE id='$id'");

header("Location: manage_membership.php");
?>