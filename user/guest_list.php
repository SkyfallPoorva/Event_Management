<?php
session_start();
include("../config/db.php");

// LOGIN CHECK
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'user') {
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// ADD GUEST
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $conn->query("INSERT INTO guest_list (user_id, name, phone, email)
                  VALUES ('$user_id', '$name', '$phone', '$email')");
}

// DELETE GUEST
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM guest_list WHERE id='$id' AND user_id='$user_id'");
}

// FETCH GUESTS
$guests = $conn->query("SELECT * FROM guest_list WHERE user_id='$user_id'");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Guest List</title>
    <style>
        body { font-family: Arial; text-align: center; }
        .box { background: #eee; padding: 20px; margin: 20px; }
        input { padding: 10px; margin: 5px; }
        button { padding: 10px 20px; background: blue; color: white; border: none; }
        .card {
            border:1px solid #000;
            margin:10px;
            padding:10px;
            background:white;
        }
        a {
            text-decoration: none;
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>

<h2>Guest List</h2>

<!-- ADD GUEST -->
<div class="box">
    <h3>Add Guest</h3>
    <form method="POST">
        <input type="text" name="name" placeholder="Guest Name" required><br>
        <input type="text" name="phone" placeholder="Phone" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <button name="add">Add Guest</button>
    </form>
</div>

<!-- VIEW GUESTS -->
<div class="box">
    <h3>Your Guests</h3>

    <?php
    if ($guests->num_rows > 0) {
        while ($row = $guests->fetch_assoc()) {
            echo "
            <div class='card'>
                <p><b>Name:</b> {$row['name']}</p>
                <p><b>Phone:</b> {$row['phone']}</p>
                <p><b>Email:</b> {$row['email']}</p>
                <a href='guest_list.php?delete={$row['id']}'>Delete</a>
            </div>
            ";
        }
    } else {
        echo "No guests added.";
    }
    ?>
</div>

<br>
<button onclick="window.location.href='dashboard.php'">Back</button>

</body>
</html>