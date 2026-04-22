<?php
session_start();
include("../config/db.php");

// CHECK LOGIN
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'vendor') {
    header("Location: ../auth/login.php");
    exit();
}

$vendor_id = $_SESSION['vendor_id'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Items</title>

    <style>
        body { font-family: Arial; text-align: center; }

        .card {
            border: 1px solid #000;
            padding: 15px;
            margin: 10px;
            display: inline-block;
            background: #f2f2f2;
        }

        .btn {
            padding: 8px 15px;
            background: blue;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

<h2>My Products</h2>

<?php
$query = "SELECT * FROM products WHERE vendor_id='$vendor_id'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "
        <div class='card'>
            <p><b>{$row['name']}</b></p>
            <p>Price: ₹{$row['price']}</p>

            <a href='delete_item.php?id={$row['id']}'>
                <button class='btn'>Delete</button>
            </a>
        </div>
        ";
    }
} else {
    echo "<h3>No products found</h3>";
}
?>

<br><br>
<button class="btn" onclick="window.location.href='dashboard.php'">Back</button>

</body>
</html>