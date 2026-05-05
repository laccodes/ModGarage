<?php
session_start();
if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
$cart_count = array_sum(array_column($_SESSION['cart'], 'qty'));
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Database Design — MOD GARAGE</title>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow+Condensed:wght@400;600;700&family=Barlow:wght@300;400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav class="nav">
  <div class="nav-logo">MOD<span>GARAGE</span></div>
  <div class="nav-links">
    <a href="index.php">HOME</a>
    <a href="database.php" class="active">DB DESIGN</a>
    <a href="cart.php" class="nav-cart">
      🛒 CART
      <?php if ($cart_count > 0): ?><span class="cart-badge"><?= $cart_count ?></span><?php endif; ?>
    </a>
  </div>
</nav>

<div class="db-page">
  <h1 class="db-page-title">DATABASE DESIGN</h1>
  <div class="db-page-sub">ENTITY RELATIONSHIP SCHEMA — MOD GARAGE</div>

  <div class="db-grid">

    <!-- VEHICLES -->
    <div class="db-table">
      <div class="db-table-header">
        <div class="db-table-name">VEHICLES</div>
        <div class="db-table-pk">6 ROWS</div>
      </div>
      <div class="db-col">
        <div class="db-col-name"><span class="db-col-key pk">PK</span> vehicle_id</div>
        <div class="db-col-type">INT AUTO_INCREMENT</div>
      </div>
      <div class="db-col">
        <div class="db-col-name">name</div>
        <div class="db-col-type">VARCHAR(100)</div>
      </div>
      <div class="db-col">
        <div class="db-col-name">chassis_code</div>
        <div class="db-col-type">VARCHAR(20)</div>
      </div>
      <div class="db-col">
        <div class="db-col-name">year</div>
        <div class="db-col-type">YEAR</div>
      </div>
      <div class="db-col">
        <div class="db-col-name">stock_hp</div>
        <div class="db-col-type">VARCHAR(30)</div>
      </div>
      <div class="db-col">
        <div class="db-col-name">category</div>
        <div class="db-col-type">ENUM('JDM','EURO','MUSCLE')</div>
      </div>
      <div class="db-col">
        <div class="db-col-name">description</div>
        <div class="db-col-type">TEXT</div>
      </div>
      <div class="db-col">
        <div class="db-col-name">image_path</div>
        <div class="db-col-type">VARCHAR(255)</div>
      </div>
    </div>

    <!-- MOD_CATEGORIES -->
    <div class="db-table">
      <div class="db-table-header">
        <div class="db-table-name">MOD_CATEGORIES</div>
        <div class="db-table-pk">4 ROWS</div>
      </div>
      <div class="db-col">
        <div class="db-col-name"><span class="db-col-key pk">PK</span> category_id</div>
        <div class="db-col-type">INT AUTO_INCREMENT</div>
      </div>
      <div class="db-col">
        <div class="db-col-name">label</div>
        <div class="db-col-type">VARCHAR(50)</div>
      </div>
    </div>

    <!-- MODS -->
    <div class="db-table">
      <div class="db-table-header">
        <div class="db-table-name">MODS</div>
        <div class="db-table-pk">8 ROWS</div>
      </div>
      <div class="db-col">
        <div class="db-col-name"><span class="db-col-key pk">PK</span> mod_id</div>
        <div class="db-col-type">VARCHAR(10)</div>
      </div>
      <div class="db-col">
        <div class="db-col-name"><span class="db-col-key fk">FK</span> category_id</div>
        <div class="db-col-type">INT</div>
      </div>
      <div class="db-col">
        <div class="db-col-name">brand</div>
        <div class="db-col-type">VARCHAR(60)</div>
      </div>
      <div class="db-col">
        <div class="db-col-name">name</div>
        <div class="db-col-type">VARCHAR(120)</div>
      </div>
      <div class="db-col">
        <div class="db-col-name">description</div>
        <div class="db-col-type">TEXT</div>
      </div>
      <div class="db-col">
        <div class="db-col-name">price</div>
        <div class="db-col-type">DECIMAL(10,2)</div>
      </div>
      <div class="db-col">
        <div class="db-col-name">image_path</div>
        <div class="db-col-type">VARCHAR(255)</div>
      </div>
    </div>

    <!-- USERS -->
    <div class="db-table">
      <div class="db-table-header">
        <div class="db-table-name">USERS</div>
        <div class="db-table-pk">—</div>
      </div>
      <div class="db-col">
        <div class="db-col-name"><span class="db-col-key pk">PK</span> user_id</div>
        <div class="db-col-type">INT AUTO_INCREMENT</div>
      </div>
      <div class="db-col">
        <div class="db-col-name">email</div>
        <div class="db-col-type">VARCHAR(150) UNIQUE</div>
      </div>
      <div class="db-col">
        <div class="db-col-name">password_hash</div>
        <div class="db-col-type">VARCHAR(255)</div>
      </div>
      <div class="db-col">
        <div class="db-col-name">full_name</div>
        <div class="db-col-type">VARCHAR(100)</div>
      </div>
      <div class="db-col">
        <div class="db-col-name">created_at</div>
        <div class="db-col-type">TIMESTAMP DEFAULT NOW()</div>
      </div>
    </div>

    <!-- ORDERS -->
    <div class="db-table">
      <div class="db-table-header">
        <div class="db-table-name">ORDERS</div>
        <div class="db-table-pk">—</div>
      </div>
      <div class="db-col">
        <div class="db-col-name"><span class="db-col-key pk">PK</span> order_id</div>
        <div class="db-col-type">INT AUTO_INCREMENT</div>
      </div>
      <div class="db-col">
        <div class="db-col-name"><span class="db-col-key fk">FK</span> user_id</div>
        <div class="db-col-type">INT</div>
      </div>
      <div class="db-col">
        <div class="db-col-name">total_amount</div>
        <div class="db-col-type">DECIMAL(10,2)</div>
      </div>
      <div class="db-col">
        <div class="db-col-name">shipping_cost</div>
        <div class="db-col-type">DECIMAL(10,2)</div>
      </div>
      <div class="db-col">
        <div class="db-col-name">status</div>
        <div class="db-col-type">ENUM('pending','confirmed','shipped','delivered')</div>
      </div>
      <div class="db-col">
        <div class="db-col-name">created_at</div>
        <div class="db-col-type">TIMESTAMP DEFAULT NOW()</div>
      </div>
    </div>

    <!-- ORDER_ITEMS -->
    <div class="db-table">
      <div class="db-table-header">
        <div class="db-table-name">ORDER_ITEMS</div>
        <div class="db-table-pk">—</div>
      </div>
      <div class="db-col">
        <div class="db-col-name"><span class="db-col-key pk">PK</span> item_id</div>
        <div class="db-col-type">INT AUTO_INCREMENT</div>
      </div>
      <div class="db-col">
        <div class="db-col-name"><span class="db-col-key fk">FK</span> order_id</div>
        <div class="db-col-type">INT</div>
      </div>
      <div class="db-col">
        <div class="db-col-name"><span class="db-col-key fk">FK</span> mod_id</div>
        <div class="db-col-type">VARCHAR(10)</div>
      </div>
      <div class="db-col">
        <div class="db-col-name"><span class="db-col-key fk">FK</span> vehicle_id</div>
        <div class="db-col-type">INT</div>
      </div>
      <div class="db-col">
        <div class="db-col-name">quantity</div>
        <div class="db-col-type">INT DEFAULT 1</div>
      </div>
      <div class="db-col">
        <div class="db-col-name">unit_price</div>
        <div class="db-col-type">DECIMAL(10,2)</div>
      </div>
    </div>

  </div>

  <div class="db-relations">
    <h2>RELATIONSHIPS</h2>
    <div class="relation-list">
      <div class="relation-item">
        <span class="relation-from">MODS</span>
        <span class="relation-arrow">→</span>
        <span class="relation-to">MOD_CATEGORIES</span>
        <span class="relation-type">MANY TO ONE · mods.category_id = mod_categories.category_id</span>
      </div>
      <div class="relation-item">
        <span class="relation-from">ORDERS</span>
        <span class="relation-arrow">→</span>
        <span class="relation-to">USERS</span>
        <span class="relation-type">MANY TO ONE · orders.user_id = users.user_id</span>
      </div>
      <div class="relation-item">
        <span class="relation-from">ORDER_ITEMS</span>
        <span class="relation-arrow">→</span>
        <span class="relation-to">ORDERS</span>
        <span class="relation-type">MANY TO ONE · order_items.order_id = orders.order_id</span>
      </div>
      <div class="relation-item">
        <span class="relation-from">ORDER_ITEMS</span>
        <span class="relation-arrow">→</span>
        <span class="relation-to">MODS</span>
        <span class="relation-type">MANY TO ONE · order_items.mod_id = mods.mod_id</span>
      </div>
      <div class="relation-item">
        <span class="relation-from">ORDER_ITEMS</span>
        <span class="relation-arrow">→</span>
        <span class="relation-to">VEHICLES</span>
        <span class="relation-type">MANY TO ONE · order_items.vehicle_id = vehicles.vehicle_id</span>
      </div>
    </div>
  </div>

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
