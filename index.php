<?php
session_start();
require "ecommerce/includes/connection.php";

$search = $_GET['search'] ?? "";

/* CART COUNT */
$count = 0;

if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $qty) {
        $count += $qty;
    }
}

/* PRODUCTS QUERY */
if ($search == "") {
    $stmt = $conn->query("SELECT id, name, price, image FROM products");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $stmt = $conn->prepare("
        SELECT id, name, price, image 
        FROM products 
        WHERE name LIKE ?
    ");
    $stmt->execute(["%$search%"]);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Official E-commerce Design</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
</head>

<body>

<div id="top"></div>

<!-- NAVBAR -->
<div class="navbar">

<div class="logo">
<i class="fa-brands fa-shopware"></i> MyShop
</div>

<div class="nav-links">

<a href="#top">Home</a>
<a href="orders.php">My Orders</a>
<a href="#products">Shop</a>

<!-- CATEGORIES -->
<div class="custom-dropdown">

<div class="dropdown-btn" onclick="toggleDropdown()">
<i class="fa-solid fa-list"></i>
<span>Categories</span>
<i class="fa-solid fa-chevron-down"></i>
</div>

<div class="dropdown-content" id="dropdown">

<a href="categories/robes.php">Dresses</a>
<a href="categories/footwear.php">Footwear</a>
<a href="categories/bags.php">Bags</a>
<a href="categories/watches.php">Watches</a>
<a href="categories/ensembleFemme.php">Women's Sets</a>
<a href="categories/bijoux.php">Jewelry</a>
<a href="categories/tShirts.php">T-Shirts</a>
<a href="categories/hoodies.php">Hoodies</a>

</div>
</div>

<!-- CART -->
<a href="ecommerce/cart.php" class="cart-icon">
    <i class="fa-solid fa-cart-shopping"></i>
    <span class="cart-count"><?php echo $count; ?></span>
</a>

<!-- USER / LOGIN -->
<?php if(isset($_SESSION['user']['id'])) { ?>

    <!-- Profile -->
    <a href="user.php" title="My Profile">
        <i class="fa-solid fa-user"></i>
    </a>

    <!-- Logout -->
    <a href="ecommerce/loyout.php" title="Logout">
        <i class="fa-solid fa-right-from-bracket"></i>
    </a>

<?php } else { ?>

    <!-- Login -->
    <a href="ecommerce/login.php" title="Login">
        <i class="fa-solid fa-right-to-bracket"></i>
    </a>

<?php } ?>




</div>
</div>

<!-- HERO -->
<div class="hero">
  <div>
    <h1>Best Online Store</h1>
    <p>Discover thousands of products at best prices</p>
    <button>Shop Now</button>
  </div>

  <div class="scene">
    <img src="img/img5.jpeg" class="tshirt">
  </div>
</div>

<div class="title" id="products">Popular Products</div>

<!-- SEARCH -->
<form method="GET" action="index.php" style="text-align:center;margin:20px 0;">
  <input type="text" name="search" placeholder="Search products..."
  value="<?php echo htmlspecialchars($search); ?>"
  style="padding:10px;width:250px;border-radius:8px;border:1px solid #ccc;">

  <button type="submit"
    style="padding:10px 15px;border:none;background:#0A4174;color:white;border-radius:8px;">
    Search
  </button>
</form>

<!-- PRODUCTS -->
<div class="products">

<?php if (empty($products)) { ?>

    <p>No products found 😕</p>

<?php } else { ?>

    <?php foreach ($products as $p) { ?>

        <div class="card"> 

            <img src="img/<?php echo htmlspecialchars(trim($p['image'])); ?>"
                 loading="lazy"
                 onerror="this.src='img/default.jfif'">

            <div class="card-body">
                <h3><?php echo $p['name']; ?></h3>
                <div class="price"><?php echo $p['price']; ?> DH</div>

                <a href="ecommerce/cart.php?id=<?php echo $p['id']; ?>">
                    <button class="btn">Add</button>
                </a>

            </div>
        </div>

    <?php } ?>

<?php } ?>

</div>

<?php include "ecommerce/includes/footer.php"; ?>

<script>
function toggleDropdown(){
    let menu = document.getElementById("dropdown");
    menu.style.display = (menu.style.display === "block") ? "none" : "block";
}

window.onclick = function(e){
    if(!e.target.closest('.custom-dropdown')){
        document.getElementById("dropdown").style.display = "none";
    }
}
</script>

</body>
</html>