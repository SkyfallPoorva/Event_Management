<?php
include("../config/db.php");

$message = "";

if (isset($_POST['signup'])) {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role = $_POST['role'];

    // 🔒 BASIC VALIDATIONS
    if ($name == "" || $email == "" || $password == "" || $role == "") {
        $message = "❌ All fields are required.";
    } 
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "❌ Invalid email format.";
    } 
    else {

        // 🔍 CHECK IF EMAIL ALREADY EXISTS (in BOTH tables)
        $checkUser = $conn->query("SELECT email FROM users WHERE email='$email'");
        $checkVendor = $conn->query("SELECT email FROM vendors WHERE email='$email'");

        if ($checkUser->num_rows > 0 || $checkVendor->num_rows > 0) {
            $message = "❌ Email already registered. Try another.";
        } 
        else {

            // 👤 USER SIGNUP
            if ($role == "user") {

                $query = "INSERT INTO users (name, email, password)
                          VALUES ('$name', '$email', '$password')";

                if ($conn->query($query)) {
                    header("Location: login.php?success=User Registered");
                    exit();
                } else {
                    $message = "❌ Error: " . $conn->error;
                }
            }

            // 🏪 VENDOR SIGNUP
            if ($role == "vendor") {

                $category = $_POST['category'];

                if ($category == "") {
                    $message = "❌ Please select a category.";
                } else {

                    $query = "INSERT INTO vendors (name, email, password, category)
                              VALUES ('$name', '$email', '$password', '$category')";

                    if ($conn->query($query)) {
                        header("Location: login.php?success=Vendor Registered");
                        exit();
                    } else {
                        $message = "❌ Error: " . $conn->error;
                    }
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
    <style>
        body {
            font-family: Arial;
            text-align: center;
            background-color: #f2f2f2;
        }
        .box {
            width: 350px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
        }
        input, select {
            width: 90%;
            padding: 10px;
            margin: 8px;
        }
        button {
            padding: 10px 20px;
            background: blue;
            color: white;
            border: none;
            cursor: pointer;
        }
        .msg {
            color: red;
        }
    </style>
</head>
<body>

<div class="box">
    <h2>Signup</h2>

    <!-- MESSAGE -->
    <?php if($message != "") { ?>
        <p class="msg"><?php echo $message; ?></p>
    <?php } ?>

    <form method="POST">

        <input type="text" name="name" placeholder="Name" required><br>

        <input type="email" name="email" placeholder="Email" required><br>

        <input type="password" name="password" placeholder="Password" required><br>

        <select name="role" onchange="toggleCategory(this.value)" required>
            <option value="">Select Role</option>
            <option value="user">User</option>
            <option value="vendor">Vendor</option>
        </select><br>

        <!-- CATEGORY (ONLY FOR VENDOR) -->
        <div id="categoryBox" style="display:none;">
            <select name="category">
                <option value="">Select Category</option>
                <option value="Catering">Catering</option>
                <option value="Florist">Florist</option>
                <option value="Decoration">Decoration</option>
                <option value="Lighting">Lighting</option>
            </select>
        </div>

        <br>
        <button name="signup">Sign Up</button>
    </form>

    <br>
    <a href="login.php">Already have an account? Login</a>
</div>

<script>
function toggleCategory(role) {
    if (role === "vendor") {
        document.getElementById("categoryBox").style.display = "block";
    } else {
        document.getElementById("categoryBox").style.display = "none";
    }
}
</script>

</body>
</html>