<?php
session_start();
include("../config/db.php");

// CHECK LOGIN
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'user') {
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Status</title>
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
            background: #f2f2f2;
        }

        .btn {
            padding: 10px;
            background: blue;
            color: white;
            border: none;
            cursor: pointer;
        }

        .cancel {
            color: red;
            font-weight: bold;
            text-decoration: none;
        }
    </style>
</head>
<body>

<h2>User Order Status</h2>

<?php
$query = "SELECT * FROM orders WHERE user_id = '$user_id'";
$result = $conn->query($query);

if (!$result) {
    die("Query Error: " . $conn->error);
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        echo "
        <div class='box'>
            <p><b>Order ID:</b> {$row['id']}</p>
            <p><b>Name:</b> {$row['name']}</p>
            <p><b>Email:</b> {$row['email']}</p>
            <p><b>Address:</b> {$row['address']}</p>
            <p><b>Status:</b> {$row['status']}</p>
        ";

        // SHOW CANCEL BUTTON ONLY WHEN ALLOWED
        if ($row['status'] == 'Received' || $row['status'] == 'Ready for Shipping') {
            echo "<a class='cancel' href='cancel_order.php?id={$row['id']}'>Cancel Order</a>";
        }

        echo "</div>";
    }
} else {
    echo "<h3>No orders found</h3>";
}
?>

<br>
<button class="btn" onclick="window.location.href='dashboard.php'">Back</button>

</body>
</html>