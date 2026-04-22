<?php
session_start();
include("../config/db.php");

if ($_SESSION['role'] != 'user') {
    header("Location: ../auth/login.php");
}

$vendor_id = $_GET['vendor_id'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
    <style>
        body {
            font-family: Arial;
            text-align: center;
        }

        .product-box {
            display: inline-block;
            width: 200px;
            padding: 20px;
            margin: 10px;
            background: lightblue;
        }

        .btn {
            padding: 10px;
            background: green;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

<h2>Products</h2>

<?php
$query = "SELECT * FROM products WHERE vendor_id='$vendor_id'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "
        <div class='product-box'>
            <h4>{$row['name']}</h4>
            <p>Price: ₹{$row['price']}</p>
            <a href='add_to_cart.php?product_id={$row['id']}'>
                <button class='btn'>Add to Cart</button>
            </a>
        </div>
        ";
    }
} else {
    echo "No products found";
}
?>

<br><br>
<a href="dashboard.php">Back</a>

</body>
</html>