<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'vendor') {
    header("Location: ../auth/login.php");
    exit();
}

// UPDATE STATUS
if (isset($_POST['update'])) {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    $conn->query("UPDATE orders SET status='$status' WHERE id='$order_id'");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Status</title>
    <style>
        body {
            font-family: Arial;
            text-align: center;
        }

        .box {
            border: 1px solid #000;
            margin: 10px auto;
            padding: 15px;
            width: 50%;
        }

        .btn {
            padding: 8px;
            background: blue;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

<h2>Update Order Status</h2>

<?php
$result = $conn->query("SELECT * FROM orders");

while ($row = $result->fetch_assoc()) {
?>

<div class="box">
<form method="POST">

<p><b>Order ID:</b> <?php echo $row['id']; ?></p>
<p><b>Name:</b> <?php echo $row['name']; ?></p>
<p><b>Status:</b> <?php echo $row['status']; ?></p>

<input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">

<input type="radio" name="status" value="Received" <?php if($row['status']=="Received") echo "checked"; ?>> Received<br>
<input type="radio" name="status" value="Ready for Shipping"> Ready for Shipping<br>
<input type="radio" name="status" value="Out for Delivery"> Out for Delivery<br><br>

<button class="btn" name="update">Update</button>

</form>
</div>

<?php } ?>

<br>
<button class="btn" onclick="window.location.href='dashboard.php'">Back</button>

</body>
</html>