<?php include 'db.php'; session_start(); ?>
<!doctype html><html><head><meta charset="utf-8"><title>Cart</title><link rel="stylesheet" href="css/style.css"></head><body>
<main class="container"><h2>Your Cart</h2>
<?php
if(!isset($_SESSION['cart']) || count($_SESSION['cart'])==0){ echo '<p>Cart is empty. <a href="shop.php">Shop now</a></p>'; exit;}
$ids = implode(',', array_map('intval', array_keys($_SESSION['cart'])));
$res = $conn->query('SELECT * FROM products WHERE id IN ('.$ids.')');
$total = 0;
echo '<table class="cart"><tr><th>Product</th><th>Qty</th><th>Price</th></tr>';
while($p = $res->fetch_assoc()){
  $qty = $_SESSION['cart'][$p['id']];
  $line = $qty * $p['price'];
  $total += $line;
  echo '<tr><td>'.htmlspecialchars($p['name']).'</td><td>'.$qty.'</td><td>'.number_format($line,2).' MAD</td></tr>';
}
echo '</table><p class="price">Total: '.number_format($total,2).' MAD</p>';
?>
<h3>Checkout</h3>
<form method="post" action="checkout.php">
  <label>Name: <input name="name" required></label><br>
  <label>Phone: <input name="phone" required></label><br>
  <label>Address: <textarea name="address" required></textarea></label><br>
  <button class="btn" type="submit">Place Order (Cash on Delivery)</button>
</form>
</main></body></html>
