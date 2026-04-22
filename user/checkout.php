<?php
session_start();
include("../config/db.php");

$user_id = $_SESSION['user_id'];

// GET CART TOTAL
$query = "
SELECT products.price, cart.quantity 
FROM cart 
JOIN products ON cart.product_id = products.id
WHERE cart.user_id='$user_id'
";

$result = $conn->query($query);

$total = 0;

while ($row = $result->fetch_assoc()) {
    $total += $row['price'] * $row['quantity'];
}

// HANDLE ORDER
if (isset($_POST['order'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $pincode = $_POST['pincode'];
    $phone = $_POST['phone'];
    $payment = $_POST['payment'];

    // INSERT ORDER
    $conn->query("
    INSERT INTO orders 
    (user_id, name, email, address, city, state, pincode, phone, payment_method, total_amount)
    VALUES 
    ('$user_id', '$name', '$email', '$address', '$city', '$state', '$pincode', '$phone', '$payment', '$total')
    ");

    $order_id = $conn->insert_id;

    // INSERT ORDER ITEMS
    $cart_items = $conn->query("SELECT * FROM cart WHERE user_id='$user_id'");

    while ($item = $cart_items->fetch_assoc()) {

        $product = $conn->query("SELECT * FROM products WHERE id='{$item['product_id']}'")->fetch_assoc();

        $conn->query("
        INSERT INTO order_items (order_id, product_id, quantity, price)
        VALUES ('$order_id', '{$item['product_id']}', '{$item['quantity']}', '{$product['price']}')
        ");
    }

    // CLEAR CART
    $conn->query("DELETE FROM cart WHERE user_id='$user_id'");

    header("Location: success.php?order_id=$order_id");
}
?>

<h2>Checkout</h2>

<form method="POST">

<input type="text" name="name" placeholder="Name" required><br><br>
<input type="email" name="email" placeholder="Email" required><br><br>
<input type="text" name="address" placeholder="Address" required><br><br>
<input type="text" name="city" placeholder="City" required><br><br>
<input type="text" name="state" placeholder="State" required><br><br>
<input type="text" name="pincode" placeholder="Pincode" required><br><br>
<input type="text" name="phone" placeholder="Phone" required><br><br>

<select name="payment" required>
    <option value="">Select Payment</option>
    <option value="Cash">Cash</option>
    <option value="UPI">UPI</option>
</select><br><br>

<h3>Total: ₹<?php echo $total; ?></h3>

<button name="order">Order Now</button>

</form>

<a href="cart.php">Back</a>