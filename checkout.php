<?php include 'db.php'; session_start();
if($_SERVER['REQUEST_METHOD']!='POST' || !isset($_SESSION['cart'])){ header('Location: shop.php'); exit; }
$name = $conn->real_escape_string($_POST['name']);
$phone = $conn->real_escape_string($_POST['phone']);
$address = $conn->real_escape_string($_POST['address']);
$ids = implode(',', array_map('intval', array_keys($_SESSION['cart'])));
$res = $conn->query('SELECT * FROM products WHERE id IN ('.$ids.')');
$total = 0;
$items = [];
while($p = $res->fetch_assoc()){
  $qty = $_SESSION['cart'][$p['id']];
  $line = $qty * $p['price'];
  $total += $line;
  $items[] = ['id'=>$p['id'],'qty'=>$qty,'price'=>$p['price']];
}
$conn->query("INSERT INTO orders (customer_name, phone, address, total) VALUES ('{$name}','{$phone}','{$address}', {$total})");
$order_id = $conn->insert_id;
foreach($items as $it){
  $conn->query("INSERT INTO order_items (order_id, product_id, qty, price) VALUES ({$order_id},{$it['id']},{$it['qty']},{$it['price']})");
  // update stock
  $conn->query('UPDATE products SET stock=stock-'.intval($it['qty']).' WHERE id='.intval($it['id']));
}
unset($_SESSION['cart']);
?>
<!doctype html><html><head><meta charset="utf-8"><title>Order placed</title><link rel="stylesheet" href="css/style.css"></head><body>
<main class="container"><h2>Thank you!</h2><p>Your order #<?=htmlspecialchars($order_id)?> has been placed. We will contact you by phone.</p><p><a href="index.php">Return home</a></p></main></body></html>
