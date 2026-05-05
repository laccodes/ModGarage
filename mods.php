<?php
session_start();
if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

$car_id   = $_GET['id']   ?? 'car1';
$car_name = $_GET['name'] ?? 'Your Car';
$car_code = $_GET['code'] ?? '';
$car_year = $_GET['year'] ?? '';
$car_hp   = $_GET['hp']   ?? '';

// Add to cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_mod'])) {
  $key = $_POST['mod_id'] . '_' . $car_id;
  if (isset($_SESSION['cart'][$key])) {
    $_SESSION['cart'][$key]['qty']++;
  } else {
    $_SESSION['cart'][$key] = [
      'mod_id'   => $_POST['mod_id'],
      'mod_name' => $_POST['mod_name'],
      'price'    => (float)$_POST['mod_price'],
      'category' => $_POST['mod_cat'],
      'car'      => $car_name,
      'car_code' => $car_code,
      'qty'      => 1,
    ];
  }
  header("Location: mods.php?id=$car_id&name=".urlencode($car_name)."&code=".urlencode($car_code)."&year=$car_year&hp=".urlencode($car_hp)."&added=1");
  exit;
}

$added = isset($_GET['added']);
$cart_mod_ids = array_column($_SESSION['cart'], 'mod_id');
$cart_count   = array_sum(array_column($_SESSION['cart'], 'qty'));

// =====================================================
//  YOUR MODS
// =====================================================
$mods = [

  'WHEELS' => [
    [
      'id'    => 'whl1',
      'brand' => 'Work',
      'name'  => 'Meister S1 18x9.5 +22',
      'desc'  => 'Iconic 3-piece split rim with deep-dish profile. Flush fitment. Set of 4.',
      'price' => 2800.00,
      'image' => 'rose wheel.jpg',
    ],
    [
      'id'    => 'whl2',
      'brand' => 'Enkei',
      'name'  => 'RPF1 17x9 +35',
      'desc'  => 'Ultra-lightweight flow-formed racing wheel. Proven in time attack. Set of 4.',
      'price' => 1200.00,
      'image' => 'wheels.jpg',
    ],
  ],

  'EXHAUST' => [
    [
      'id'    => 'exh1',
      'brand' => 'HKS',
      'name'  => 'Hi-Power Cat-Back',
      'desc'  => '3" stainless steel. Deep throaty tone with significant mid-range flow gains.',
      'price' => 1149.00,
      'image' => 'pink exhaust.jpg',
    ],
    [
      'id'    => 'exh2',
      'brand' => 'Tomei',
      'name'  => 'Expreme Ti Full System',
      'desc'  => 'Full titanium construction. Race-level weight savings with an aggressive high-rev scream.',
      'price' => 2400.00,
      'image' => 'black exhaust.jpg',
    ],
  ],

  'SEATS' => [
    [
      'id'    => 'seat1',
      'brand' => 'Bride',
      'name'  => 'ZETA III Racing Seat',
      'desc'  => 'FIA-certified FRP shell. Ultra-low profile with maximum lateral support. Each.',
      'price' => 1749.00,
      'image' => 'red leather.jpg',
    ],
    [
      'id'    => 'seat2',
      'brand' => 'Recaro',
      'name'  => 'SR-7 Bucket Seat',
      'desc'  => 'Street-legal steel shell bucket. Homologated for daily driving and track days. Each.',
      'price' => 1200.00,
      'image' => 'white seats.jpg',
    ],
  ],

  'LIGHTS' => [
    [
      'id'    => 'lgt1',
      'brand' => 'Spec-D',
      'name'  => 'Bi-Xenon Projector Headlights',
      'desc'  => 'HID 6000K with razor-sharp beam pattern. OEM-style fitment. Pair.',
      'price' => 349.00,
      'image' => 'pink lights.jpg',
    ],
    [
      'id'    => 'lgt2',
      'brand' => 'Morimoto',
      'name'  => 'XB LED Headlights',
      'desc'  => 'Plug-and-play full LED system with sequential DRL halo ring. Pair.',
      'price' => 649.00,
      'image' => 'blue lights.jpg',
    ],
  ],

];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($car_name) ?> Mods — MOD GARAGE</title>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow+Condensed:wght@400;600;700&family=Barlow:wght@300;400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php if ($added): ?>
<div class="flash">✓ MOD ADDED TO CART</div>
<?php endif; ?>

<nav class="nav">
  <div class="nav-logo">MOD<span>GARAGE</span></div>
  <div class="nav-links">
    <a href="index.php">HOME</a>
    <a href="database.php">DB DESIGN</a>
    <a href="cart.php" class="nav-cart">
      🛒 CART
      <?php if ($cart_count > 0): ?><span class="cart-badge"><?= $cart_count ?></span><?php endif; ?>
    </a>
  </div>
</nav>

<section class="mods-hero">
  <a href="index.php" class="back-link">← BACK TO VEHICLES</a>
  <h1 class="mods-title"><?= htmlspecialchars($car_name) ?></h1>
  <div class="mods-sub">
    <?= htmlspecialchars($car_code) ?> · <?= htmlspecialchars($car_year) ?> ·
    <span><?= htmlspecialchars($car_hp) ?> STOCK</span>
  </div>
</section>

<section class="mods-section">
  <?php foreach ($mods as $cat_label => $items): ?>
  <div class="mod-category">

    <div class="mod-cat-header">
      <h2 class="mod-cat-title"><?= $cat_label ?></h2>
      <span class="mod-cat-count"><?= count($items) ?> MODS</span>
    </div>

    <div class="mod-grid">
      <?php foreach ($items as $mod):
        $in_cart = in_array($mod['id'], $cart_mod_ids); ?>
      <div class="mod-card <?= $in_cart ? 'in-cart' : '' ?>">

        <!-- MOD IMAGE -->
        <div class="mod-img-wrap">
          <img src="<?= htmlspecialchars($mod['image']) ?>" alt="<?= htmlspecialchars($mod['name']) ?>" class="mod-img">
        </div>

        <div class="mod-body">
          <div class="mod-brand"><?= htmlspecialchars($mod['brand']) ?></div>
          <div class="mod-name"><?= htmlspecialchars($mod['name']) ?></div>
          <div class="mod-desc"><?= htmlspecialchars($mod['desc']) ?></div>

          <div class="mod-bottom">
            <div class="mod-price">$<?= number_format($mod['price'], 2) ?></div>
            <?php if ($in_cart): ?>
              <button class="add-btn added" disabled>✓ IN CART</button>
            <?php else: ?>
              <form method="POST" style="margin:0;">
                <input type="hidden" name="mod_id"    value="<?= htmlspecialchars($mod['id']) ?>">
                <input type="hidden" name="mod_name"  value="<?= htmlspecialchars($mod['name']) ?>">
                <input type="hidden" name="mod_price" value="<?= $mod['price'] ?>">
                <input type="hidden" name="mod_cat"   value="<?= htmlspecialchars($cat_label) ?>">
                <button type="submit" name="add_mod" class="add-btn">ADD TO BUILD</button>
              </form>
            <?php endif; ?>
          </div>
        </div>

      </div>
      <?php endforeach; ?>
    </div>
  </div>
  <?php endforeach; ?>
</section>

<?php if ($cart_count > 0): ?>
<div class="sticky-bar">
  <span><strong><?= $cart_count ?></strong> item<?= $cart_count != 1 ? 's' : '' ?> in your build</span>
  <a href="cart.php" class="checkout-btn">VIEW CART →</a>
</div>
<?php endif; ?>

<footer class="footer">
  <div class="footer-logo">MOD<span>GARAGE</span></div>
  <p>© 2026 ModGarage. All rights reserved.</p>
  <div class="footer-links">
    <a href="database.php">DB Design</a>
    <a href="cart.php">Cart</a>
  </div>
</footer>

</body>
</html>
