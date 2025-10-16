<?php include 'db.php'; session_start(); ?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Shop - Elmamony</title><link rel="stylesheet" href="css/style.css"></head>
<body>
<header><h1>Shop - Elmamony</h1><a href="index.php">Home</a> | <a href="cart.php">Cart</a></header>
<main class="container">
  <div class="products">
    <?php
    $res = $conn->query('SELECT * FROM products');
    while($p = $res->fetch_assoc()){
      $avail = $p['stock']>0 ? 'In stock ('.$p['stock'].')' : 'Out of stock';
      echo '<div class="card"><img src="'.htmlspecialchars($p['image']).'"><h3>'.htmlspecialchars($p['name']).'</h3><p>'.htmlspecialchars($p['description']).'</p><p class="price">'.number_format($p['price'],2).' MAD</p><p>'.$avail.'</p><a href="product.php?id='.$p['id'].'" class="btn">View</a></div>';
    }
    ?>
  </div>
</main>
</body>
</html>
