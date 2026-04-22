<?php
session_start();
include("../config/db.php");

// Admin check
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit();
}

$id = $_GET['id'];

// Fetch existing data
$result = $conn->query("SELECT * FROM membership WHERE id=$id");
$data = $result->fetch_assoc();

// Update logic
if (isset($_POST['update'])) {
    $plan = $_POST['plan'];
    $price = $_POST['price'];
    $duration = $_POST['duration'];

    $conn->query("UPDATE membership 
                  SET plan='$plan', price='$price', duration='$duration'
                  WHERE id=$id");

    header("Location: manage_membership.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Membership</title>
    <style>
        body { font-family: Arial; text-align: center; }
        .box { background: #eee; padding: 20px; margin: 50px auto; width: 40%; }
        input { padding: 10px; margin: 10px; width: 80%; }
        button { padding: 10px 20px; background: blue; color: white; border: none; }
    </style>
</head>
<body>

<div class="box">
    <h2>Update Membership</h2>

    <form method="POST">
        <input type="text" name="plan" value="<?= $data['plan'] ?>" required><br>
        <input type="number" name="price" value="<?= $data['price'] ?>" required><br>
        <input type="number" name="duration" value="<?= $data['duration'] ?>" required><br>

        <button name="update">Update</button>
    </form>

    <br>
    <a href="manage_membership.php">Back</a>
</div>

</body>
</html>