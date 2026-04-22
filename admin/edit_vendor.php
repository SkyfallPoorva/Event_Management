<?php
include("../config/db.php");

$id = $_GET['id'];

$result = $conn->query("SELECT * FROM vendors WHERE id=$id");
$vendor = $result->fetch_assoc();

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $category = $_POST['category'];

    $conn->query("UPDATE vendors 
                  SET name='$name', category='$category' 
                  WHERE id=$id");

    header("Location: manage_vendors.php");
}
?>

<h2>Edit Vendor</h2>

<form method="POST">
    <input type="text" name="name" value="<?= $vendor['name'] ?>"><br><br>
    <input type="text" name="category" value="<?= $vendor['category'] ?>"><br><br>

    <button name="update">Update</button>
</form>