<?php
session_start();
include("../config/db.php");

// CHECK LOGIN
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'vendor') {
    header("Location: ../auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Vendor Transactions</title>

    <style>
        body {
            font-family: Arial;
            text-align: center;
        }

        .container {
            width: 80%;
            margin: auto;
        }

        .card {
            border: 1px solid #000;
            margin: 15px;
            padding: 15px;
            background: #f2f2f2;
        }

        .btn {
            padding: 10px 20px;
            background: blue;
            color: white;
            border: none;
            cursor: pointer;
        }

        .status {
            font-weight: bold;
            color: green;
        }
    </style>
</head>
<body>

<h2>Vendor Transactions</h2>

<div class="container">

<?php
$query = "SELECT * FROM orders ORDER BY id DESC";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        echo "
        <div class='card'>
            <p><b>Order ID:</b> {$row['id']}</p>
            <p><b>Name:</b> {$row['name']}</p>
            <p><b>Email:</b> {$row['email']}</p>
            <p><b>Phone:</b> {$row['phone']}</p>
            <p><b>Address:</b> {$row['address']}, {$row['city']}, {$row['state']} - {$row['pincode']}</p>
            <p><b>Payment:</b> {$row['payment_method']}</p>
            <p><b>Total Amount:</b> ₹{$row['total_amount']}</p>
            <p><b>Status:</b> <span class='status'>{$row['status']}</span></p>
        </div>
        ";
    }
} else {
    echo "<h3>No transactions found</h3>";
}
?>

</div>

<br>

<button class="btn" onclick="window.location.href='dashboard.php'">Back</button>

</body>
</html>