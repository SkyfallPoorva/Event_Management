<?php
include("../config/db.php");

$id = $_GET['id'];

$conn->query("DELETE FROM vendors WHERE id=$id");

header("Location: manage_vendors.php");
?>