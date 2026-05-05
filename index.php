<?php session_start(); if (!isset($_SESSION['cart'])) $_SESSION['cart'] = []; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>MOD GARAGE</title>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow+Condensed:wght@400;600;700&family=Barlow:wght@300;400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav class="nav">
  <div class="nav-logo">MOD<span>GARAGE</span></div>
  <div class="nav-links">
    <a href="index.php" class="active">HOME</a>
    <a href="database.php">DB DESIGN</a>
    <a href="cart.php" class="nav-cart">
      🛒 CART
      <?php $count = array_sum(array_column($_SESSION['cart'], 'qty')); ?>
      <?php if ($count > 0): ?><span class="cart-badge"><?= $count ?></span><?php endif; ?>
    </a>
  </div>
</nav>

<section class="hero">
  <div class="hero-bg"></div>
  <div class="hero-content">
    <div class="hero-tag">— YOUR GARAGE</div>
    <h1 class="hero-title">BUILD YOUR<br><span class="red">PERFECT</span><br>MACHINE.</h1>
    <p class="hero-sub">Select your vehicle and shop performance, suspension, brakes, and aesthetic upgrades built for your build.</p>
    <a href="#vehicles" class="hero-btn">SELECT YOUR CAR</a>
  </div>
  <div class="hero-stats">
    <div class="stat"><span class="stat-num">6</span><span class="stat-label">VEHICLES</span></div>
    <div class="stat"><span class="stat-num">20+</span><span class="stat-label">MODS</span></div>
    <div class="stat"><span class="stat-num">FREE</span><span class="stat-label">SHIPPING $500+</span></div>
  </div>
</section>

<section class="vehicles" id="vehicles">
  <div class="section-header">
    <div class="section-tag">AVAILABLE VEHICLES</div>
    <div class="section-count">6 MODELS</div>
  </div>

  <div class="car-grid">
    <?php

    // =====================================================
    //   6 CARS 
    // =====================================================
    $cars = [
      [
        'id'    => 'car1',
        'name'  => 'BMW M3',       // ← Change car name
        'code'  => 'MK4',                // ← Change chassis code
        'year'  => '1998',               // ← Change year
        'hp'    => '320 HP',             // ← Change stock HP
        'cat'   => 'JDM',                // ← Change category
        'desc'  => '2JZ-GTE. The legend.', // ← Change description
        'image' => 'black-bmw.jpg', 
      ],
      [
        'id'    => 'car2',
        'name'  => 'Lamborghini Skyline GT-R',
        'code'  => 'R34',
        'year'  => '2022',
        'hp'    => '276 HP',
        'cat'   => 'JDM',
        'desc'  => 'RB26DETT twin-turbo icon.',
        'image' => 'lamborghini.avif', 
      ],
      [
        'id'    => 'car3',
        'name'  => 'Porsche 911 Turbo',
        'code'  => 'FD3S',
        'year'  => '1993',
        'hp'    => '255 HP',
        'cat'   => 'JDM',
        'desc'  => '13B rotary, lightweight, perfect.',
        'image' => 'porsche-911.jpeg',
      ],
      [
        'id'    => 'car4',
        'name'  => 'Chevrolet Corvette Z06',
        'code'  => 'E46',
        'year'  => '2003',
        'hp'    => '343 HP',
        'cat'   => 'EURO',
        'desc'  => 'High-revving S54 inline-six.',
        'image' => 'chevrolet-corvette.jpeg', 
      ],
      [
        'id'    => 'car5',
        'name'  => 'Ford Bronco',
        'code'  => 'S550',
        'year'  => '2018',
        'hp'    => '460 HP',
        'cat'   => 'MUSCLE',
        'desc'  => 'Coyote 5.0 V8 American icon.',
        'image' => 'ford bronco.png',
      ],
      [
        'id'    => 'car6',
        'name'  => 'G Wagon 500E',
        'code'  => 'AP2',
        'year'  => '2006',
        'hp'    => '237 HP',
        'cat'   => 'JDM',
        'desc'  => '9000 RPM naturally-aspirated joy.',
        'image' => 'gwagon.png', 
      ],
    ];

    foreach ($cars as $car): ?>
    <a class="car-card" href="mods.php?id=<?= $car['id'] ?>&name=<?= urlencode($car['name']) ?>&code=<?= urlencode($car['code']) ?>&year=<?= $car['year'] ?>&hp=<?= urlencode($car['hp']) ?>">
      <div class="car-img-wrap">
        <img src="<?= $car['image'] ?>" alt="<?= htmlspecialchars($car['name']) ?>" class="car-img">
        <div class="car-overlay">VIEW MODS →</div>
      </div>
      <div class="car-info">
        <div class="car-top">
          <span class="car-year"><?= $car['year'] ?></span>
          <span class="car-hp"><?= $car['hp'] ?></span>
        </div>
        <h3 class="car-name"><?= htmlspecialchars($car['name']) ?></h3>
        <div class="car-code"><?= htmlspecialchars($car['code']) ?></div>
        <p class="car-desc"><?= htmlspecialchars($car['desc']) ?></p>
        <span class="car-cat"><?= $car['cat'] ?></span>
      </div>
    </a>
    <?php endforeach; ?>
  </div>
</section>

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
