<?php
session_start();
include("../config/db.php");

// SECURE LOGIN CHECK
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'user') {
    header("Location: ../auth/login.php");
    exit();
}

// GET CATEGORY FILTER
$category = "";
if (isset($_GET['category'])) {
    $category = $_GET['category'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>

    <style>
        body {
            font-family: Arial;
            text-align: center;
            background: #f5f5f5;
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
            border-radius: 5px;
        }

        .btn:hover {
            background: darkblue;
        }

        .vendor-box {
            display: inline-block;
            width: 220px;
            margin: 15px;
            padding: 20px;
            background: #cfe8f3;
            border-radius: 10px;
        }

        select, button[type="submit"] {
            padding: 10px;
            margin: 5px;
        }
    </style>
</head>
<body>

<div class="container">

    <h2>WELCOME USER</h2>

    <!-- CATEGORY FILTER -->
    <form method="GET">
        <select name="category">
            <option value="">Select Category</option>

            <option value="Catering" <?php if($category=="Catering") echo "selected"; ?>>Catering</option>
            <option value="Florist" <?php if($category=="Florist") echo "selected"; ?>>Florist</option>
            <option value="Decoration" <?php if($category=="Decoration") echo "selected"; ?>>Decoration</option>
            <option value="Lighting" <?php if($category=="Lighting") echo "selected"; ?>>Lighting</option>
        </select>

        <button type="submit">Filter</button>
    </form>

    <br>

    <!-- NAVIGATION -->
    <button class="btn" onclick="window.location.href='vendors.php'">Vendor</button>

    <button class="btn" onclick="window.location.href='cart.php'">Cart</button>

    <button class="btn" onclick="window.location.href='guest_list.php'">Guest List</button>

    <button class="btn" onclick="window.location.href='order_status.php'">Order Status</button>

    <br><br>

    <!-- VENDORS -->
    <h3>Vendors</h3>

    <?php
    if ($category != "") {
        $query = "SELECT * FROM vendors WHERE category='$category'";
    } else {
        $query = "SELECT * FROM vendors";
    }

    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "
            <div class='vendor-box'>
                <h4>{$row['name']}</h4>
                <p>{$row['category']}</p>

                <button class='btn' onclick=\"window.location.href='products.php?vendor_id={$row['id']}'\">
                    Shop Item
                </button>
            </div>
            ";
        }
    } else {
        echo "<h4>No vendors found</h4>";
    }
    ?>

    <br><br>

    <a href="../auth/logout.php">Logout</a>

</div>

</body>
</html>