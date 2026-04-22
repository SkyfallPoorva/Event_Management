<?php
session_start();

// Proper session check
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial;
            text-align: center;
            background-color: #f5f5f5;
        }

        .container {
            margin-top: 50px;
        }

        h2 {
            margin-bottom: 30px;
        }

        .btn {
            padding: 15px 25px;
            margin: 10px;
            background-color: blue;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        .btn:hover {
            background-color: darkblue;
        }

        .logout {
            background-color: red;
        }

        .box {
            background: white;
            padding: 30px;
            width: 60%;
            margin: auto;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.2);
        }
    </style>
</head>

<body>

<div class="container">
    <div class="box">
        <h2>Welcome Admin</h2>

        <button class="btn" onclick="window.location.href='manage_users.php'">
            Manage Users
        </button>

        <button class="btn" onclick="window.location.href='manage_vendors.php'">
            Manage Vendors
        </button>

        <button class="btn" onclick="window.location.href='manage_membership.php'">
            Membership
        </button>

        <br><br>

        <button class="btn logout" onclick="window.location.href='../auth/logout.php'">
            Logout
        </button>
    </div>
</div>

</body>
</html>