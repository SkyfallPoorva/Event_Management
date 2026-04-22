<?php
session_start();
include("../config/db.php");

$user_id = $_SESSION['user_id'];
?>

<h2>Your Cart</h2>

<?php
$query = "
SELECT products.name, products.price, cart.quantity, products.id 
FROM cart 
JOIN products ON cart.product_id = products.id
WHERE cart.user_id='$user_id'
";

$result = $conn->query($query);

$total = 0;

while ($row = $result->fetch_assoc()) {
    $subtotal = $row['price'] * $row['quantity'];
    $total += $subtotal;

    echo "
    <p>
        {$row['name']} - ₹{$row['price']} × {$row['quantity']} = ₹$subtotal
    </p>
    ";
}

echo "<h3>Total: ₹$total</h3>";
?>

<a href="checkout.php">Proceed to Checkout</a><br>
<a href="dashboard.php">Back</a>