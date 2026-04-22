<?php
session_start();
include("../config/db.php");

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // ADMIN LOGIN
    if ($role == "admin") {
        $query = "SELECT * FROM admin WHERE username='$email' AND password='$password'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $_SESSION['role'] = 'admin';
            header("Location: ../admin/dashboard.php");
        } else {
            echo "Invalid Admin Credentials";
        }
    }

    // USER LOGIN
    if ($role == "user") {
        $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['role'] = 'user';
            $_SESSION['user_id'] = $row['id'];
            header("Location: ../user/dashboard.php");
        } else {
            echo "Invalid User Credentials";
        }
    }

    // VENDOR LOGIN
    if ($role == "vendor") {
        $query = "SELECT * FROM vendors WHERE email='$email' AND password='$password'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['role'] = 'vendor';
            $_SESSION['vendor_id'] = $row['id'];
            header("Location: ../vendor/dashboard.php");
        } else {
            echo "Invalid Vendor Credentials";
        }
    }
}
?>

<h2>Login</h2>

<form method="POST">
    <input type="text" name="email" placeholder="Email / Username" required><br><br>
    
    <input type="password" name="password" placeholder="Password" required><br><br>

    <select name="role" required>
        <option value="">Select Role</option>
        <option value="admin">Admin</option>
        <option value="user">User</option>
        <option value="vendor">Vendor</option>
    </select><br><br>

    <button name="login">Login</button>
</form>