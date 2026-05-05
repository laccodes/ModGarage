<?php
session_start();
if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

if (isset($_GET['remove'])) {
  unset($_SESSION['cart'][$_GET['remove']]);
  header('Location: cart.php');
  exit;
}

if (isset($_GET['clear'])) {
  $_SESSION['cart'] = [];
  header('Location: cart.php');
  exit;
}

$cart       = $_SESSION['cart'];
$cart_count = array_sum(array_column($cart, 'qty'));
$subtotal   = array_sum(array_map(fn($i) => $i['price'] * $i['qty'], $cart));
$shipping   = ($subtotal >= 500 || $subtotal === 0.0) ? 0 : 49.99;
$total      = $subtotal + $shipping;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cart — MOD GARAGE</title>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow+Condensed:wght@400;600;700&family=Barlow:wght@300;400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav class="nav">
  <div class="nav-logo">MOD<span>GARAGE</span></div>
  <div class="nav-links">
    <a href="index.php">HOME</a>
    <a href="database.php">DB DESIGN</a>
    <a href="cart.php" class="nav-cart active">
      🛒 CART
      <?php if ($cart_count > 0): ?><span class="cart-badge"><?= $cart_count ?></span><?php endif; ?>
    </a>
  </div>
</nav>

<div class="cart-page">
  <h1 class="cart-page-title">YOUR BUILD</h1>
  <div class="cart-page-sub"><?= $cart_count ?> ITEM<?= $cart_count != 1 ? 'S' : '' ?> IN CART</div>

  <?php if (empty($cart)): ?>
  <div class="cart-empty">
    <div class="cart-empty-icon">🛒</div>
    <h2>YOUR CART IS EMPTY</h2>
    <p>Head back to the garage and start building your dream machine.</p>
    <a href="index.php" class="btn-primary">BROWSE VEHICLES</a>
  </div>

  <?php else: ?>
  <div class="cart-items">
    <?php foreach ($cart as $key => $item): ?>
    <div class="cart-item">
      <div class="cart-item-info">
        <div class="cart-item-mod"><?= htmlspecialchars($item['mod_name']) ?></div>
        <div class="cart-item-car"><?= htmlspecialchars($item['car']) ?> · <?= htmlspecialchars($item['car_code']) ?></div>
        <div class="cart-item-cat"><?= htmlspecialchars($item['category']) ?></div>
      </div>
      <div class="cart-item-price">$<?= number_format($item['price'] * $item['qty'], 2) ?></div>
      <a href="cart.php?remove=<?= urlencode($key) ?>" class="cart-remove">REMOVE</a>
    </div>
    <?php endforeach; ?>
  </div>

  <div class="cart-summary">
    <div class="cart-summary-row">
      <span>SUBTOTAL</span>
      <span>$<?= number_format($subtotal, 2) ?></span>
    </div>
    <div class="cart-summary-row">
      <span>SHIPPING</span>
      <span><?= $shipping === 0 ? 'FREE' : '$' . number_format($shipping, 2) ?></span>
    </div>
    <?php if ($subtotal < 500): ?>
    <div class="cart-summary-row">
      <span>FREE SHIPPING AT $500</span>
      <span>$<?= number_format(500 - $subtotal, 2) ?> AWAY</span>
    </div>
    <?php endif; ?>
    <div class="cart-total-row">
      <div class="cart-total-label">TOTAL</div>
      <div class="cart-total-amount">$<?= number_format($total, 2) ?></div>
    </div>
    <div class="cart-actions">
      <a href="cart.php?clear=1" class="btn-ghost">CLEAR CART</a>
      <a href="index.php" class="btn-ghost">ADD MORE</a>
      <button class="btn-checkout" onclick="alert('Checkout coming soon!')">CHECKOUT →</button>
    </div>
  </div>
  <?php endif; ?>
</div>

<footer class="footer">
  <div class="footer-logo">MOD<span>GARAGE</span></div>
  <p>© 2026 ModGarage. All rights reserved.</p>
  <div class="footer-links">
    <a href="database.php">DB Design</a>
    <a href="cart.php">Cart</a>
  </div>
</footer>

<script src="js/main.js"></script>
</body>
</html>
