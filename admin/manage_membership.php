<?php
session_start();
include("../config/db.php");

// Admin check
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit();
}

// Add membership
if (isset($_POST['add'])) {
    $vendor_id = $_POST['vendor_id'];
    $plan = $_POST['plan'];
    $price = $_POST['price'];
    $duration = $_POST['duration'];

    $conn->query("INSERT INTO membership (vendor_id, plan, price, duration)
                  VALUES ('$vendor_id', '$plan', '$price', '$duration')");
}

// Fetch vendors
$vendors = $conn->query("SELECT * FROM vendors");

// Fetch memberships
$memberships = $conn->query("SELECT m.*, v.name 
                            FROM membership m 
                            JOIN vendors v ON m.vendor_id = v.id");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Membership Management</title>
    <style>
        body { font-family: Arial; text-align: center; }
        .box { background: #eee; padding: 20px; margin: 20px; }
        input, select { padding: 10px; margin: 5px; }
        button { padding: 10px 20px; background: blue; color: white; border: none; }
        .card {
            border:1px solid #000;
            margin:10px;
            padding:10px;
            background:white;
        }
        a {
            text-decoration: none;
            font-weight: bold;
        }
        .delete {
            color: red;
        }
    </style>
</head>
<body>

<h2>Membership Management</h2>

<!-- ADD MEMBERSHIP -->
<div class="box">
    <h3>Add Membership</h3>

    <form method="POST">
        <select name="vendor_id" required>
            <option value="">Select Vendor</option>
            <?php while($v = $vendors->fetch_assoc()) { ?>
                <option value="<?= $v['id'] ?>"><?= $v['name'] ?></option>
            <?php } ?>
        </select><br>

        <input type="text" name="plan" placeholder="Plan (Basic/Premium)" required><br>
        <input type="number" name="price" placeholder="Price" required><br>
        <input type="number" name="duration" placeholder="Duration (days)" required><br>

        <button name="add">Add Membership</button>
    </form>
</div>

<!-- VIEW MEMBERSHIPS -->
<div class="box">
    <h3>Existing Memberships</h3>

    <?php
    if ($memberships->num_rows > 0) {
        while ($row = $memberships->fetch_assoc()) {
            echo "
            <div class='card'>
                <p><b>Vendor:</b> {$row['name']}</p>
                <p><b>Plan:</b> {$row['plan']}</p>
                <p><b>Price:</b> {$row['price']}</p>
                <p><b>Duration:</b> {$row['duration']} days</p>

                <a href='edit_membership.php?id={$row['id']}'>Update</a> |
                <a class='delete' href='delete_membership.php?id={$row['id']}'>Delete</a>
            </div>
            ";
        }
    } else {
        echo "No memberships found.";
    }
    ?>
</div>

<br>
<a href="dashboard.php">⬅ Back to Dashboard</a>

</body>
</html>