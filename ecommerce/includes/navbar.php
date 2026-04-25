<div class="navbar">

  <div class="logo">
    <h2><i class="fa-brands fa-shopware"></i> MyShop</h2>
  </div>

  <div class="nav-links">
    <a href="index.php">Home</a>
    <a href="orders.php">My Orders</a>
    <a href="index.php#products">Shop</a>
    <a href="deals.php">Deals</a>
  </div>

  <div class="custom-dropdown">

    <div class="dropdown-btn" onclick="toggleDropdown()">
      <i class="fa-solid fa-list"></i>
      <span>Categories</span>
      <i class="fa-solid fa-chevron-down"></i>
    </div>

    <div class="dropdown-content" id="dropdown">

      <a href="categories/robes.php">
        <i class="fa-solid fa-person-dress"></i> Dresses
      </a>

      <a href="categories/footwear.php">
        <i class="fa-solid fa-shoe-prints"></i> Footwear
      </a>

      <a href="categories/bags.php">
        <i class="fa-solid fa-briefcase"></i> Bags
      </a>

      <a href="categories/watches.php">
        <i class="fa-regular fa-clock"></i> Watches
      </a>

      <a href="categories/bijoux.php">
        <i class="fa-solid fa-gem"></i> Jewelry
      </a>

    </div>

  </div>

  <div class="icons">

    <a href="cart.php" style="position:relative;">
      <i class="fa-solid fa-cart-shopping"></i>
      <span class="cart-count"><?php echo $count; ?></span>
    </a>

    <a href="user.php">
      <i class="fa-solid fa-user"></i>
    </a>

  </div>

</div>