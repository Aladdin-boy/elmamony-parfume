<?php include 'db.php'; session_start(); ?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Elmamony Parfums</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header class="hero">
  <h1>Elmamony Parfums</h1>
  <p>Luxury perfumes — Manage sales, orders & stock</p>
  <a class="btn" href="shop.php">Shop Now</a>
</header>
<main class="container">
  <h2>Featured</h2>
  <div class="products">
    <?php
    $res = $conn->query('SELECT * FROM products LIMIT 4');
    while($p = $res->fetch_assoc()){
      echo '<div class="card"><img src="'.htmlspecialchars($p['image']).'"><h3>'.htmlspecialchars($p['name']).'</h3><p>'.htmlspecialchars($p['description']).'</p><p class="price">'.number_format($p['price'],2).' MAD</p><a href="product.php?id='.$p['id'].'" class="btn">View</a></div>';
    }
    ?>
  </div>
</main>
<footer>
  <p>&copy; Elmamony Parfums</p>
</footer>
</body>
</html>
