<?php
session_start();
include("../config/db.php");

if ($_SESSION['role'] != 'vendor') {
    header("Location: ../auth/login.php");
}

$vendor_id = $_SESSION['vendor_id'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Vendor Dashboard</title>
    <style>
        body {
            font-family: Arial;
            text-align: center;
        }

        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
        }

        .btn {
            padding: 12px 20px;
            margin: 10px;
            background: blue;
            color: white;
            border: none;
            cursor: pointer;
        }

        .box {
            background: lightblue;
            padding: 20px;
        }
    </style>
</head>
<body>

<div class="container">

    <div class="box">
        <h2>Welcome Vendor</h2>

        <button class="btn" onclick="window.location.href='my_items.php'">Your Items</button>

        <button class="btn" onclick="window.location.href='add_item.php'">Add New Item</button>


        <button class="btn" onclick="window.location.href='../auth/logout.php'">Logout</button>

        <button class="btn" onclick="window.location.href='transactions.php'">
            Transactions
        </button>
        

    </div>

</div>

</body>
</html>