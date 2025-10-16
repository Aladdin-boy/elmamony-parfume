<?php include 'db.php'; session_start(); 
if(!isset($_GET['id'])){ header('Location: shop.php'); exit; }
$id = (int)$_GET['id'];
$res = $conn->query('SELECT * FROM products WHERE id='.$id);
$p = $res->fetch_assoc();
if(!$p){ echo 'Product not found'; exit; }
if($_SERVER['REQUEST_METHOD']=='POST'){
  $qty = max(1,(int)$_POST['qty']);
  if(!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
  if(isset($_SESSION['cart'][$id])) $_SESSION['cart'][$id] += $qty; else $_SESSION['cart'][$id] = $qty;
  header('Location: cart.php'); exit;
}
?>
<!doctype html><html><head><meta charset="utf-8"><title><?=htmlspecialchars($p['name'])?></title><link rel="stylesheet" href="css/style.css"></head><body>
<main class="container">
<h2><?=htmlspecialchars($p['name'])?></h2>
<img src="<?=htmlspecialchars($p['image'])?>" style="max-width:300px">
<p><?=htmlspecialchars($p['description'])?></p>
<p class="price"><?=number_format($p['price'],2)?> MAD</p>
<p>Stock: <?=intval($p['stock'])?></p>
<?php if($p['stock']>0): ?>
  <form method="post"><label>Qty: <input name="qty" type="number" value="1" min="1" max="<?=intval($p['stock'])?>"></label><button class="btn" type="submit">Add to cart</button></form>
<?php else: ?>
  <p>Out of stock</p>
<?php endif; ?>
<p><a href="shop.php">Back to shop</a></p>
</main></body></html>
