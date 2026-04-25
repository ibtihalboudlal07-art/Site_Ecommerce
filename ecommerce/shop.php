<?php
include("../ecommerce/includes/connection.php");

$group = $_GET['group'] ?? "";

/* filter by category */
if($group != ""){
    $sql = $conn->prepare("SELECT * FROM products WHERE category = ?");
    $sql->execute([$group]);
}else{
    $sql = $conn->query("SELECT * FROM products");
}

$products = $sql->fetchAll(PDO::FETCH_ASSOC);
?>
<?php

include("includes/connection.php");

/* جلب المنتجات من database */
$sql = $conn->query("SELECT * FROM products ORDER BY id DESC");
$products = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Shop</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
body{
font-family:Arial;
background:#eef3f9;
margin:0;
}

/* NAVBAR */
.navbar{
background:#0A4174;
color:white;
padding:15px 30px;
display:flex;
justify-content:space-between;
align-items:center;
}

.navbar a{
color:white;
text-decoration:none;
margin:0 10px;
font-weight:500;
}

.navbar a:hover{
color:#00d4ff;
}

/* GRID */
.container{
padding:20px;
display:grid;
grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
gap:20px;
}

/* CARD */
.card{
background:white;
padding:10px;
border-radius:10px;
box-shadow:0 5px 15px rgba(0,0,0,0.1);
text-align:center;
transition:0.3s;
}

.card:hover{
transform:translateY(-5px);
}

.card img{
width:100%;
height:180px;
object-fit:cover;
border-radius:10px;
}

.price{
color:#0A4174;
font-weight:bold;
margin:5px 0;
}

button{
background:#0A4174;
color:white;
border:none;
padding:8px;
border-radius:6px;
cursor:pointer;
width:100%;
}

button:hover{
background:#083055;
}

/* TITLE */
.title{
text-align:center;
font-size:22px;
margin:20px 0;
color:#0A4174;
font-weight:bold;
}
</style>

</head>

<body>

<!-- NAVBAR -->
<div class="navbar">

<h2>🛍️ MyShop</h2>

<div>
<a href="index.php">Home</a>
<a href="shop.php">Shop</a>
<a href="categories.php">Categories</a>
<a href="deals.php">Deals</a>
<a href="orders.php">My Orders</a>
</div>

<a href="ecommerce/cart.php">
<i class="fa-solid fa-cart-shopping"></i> Cart
</a>

</div>

<!-- TITLE -->
<div class="title">All Products</div>

<!-- PRODUCTS -->
<div class="container">

<?php foreach($products as $p){ ?>

<div class="card">

<img src="img/<?php echo $p['img']; ?>">

<h3><?php echo $p['name']; ?></h3>

<div class="price">
<?php echo $p['price']; ?> DH
</div>

<a href="ecommerce/cart.php?id=<?php echo $p['id']; ?>">
<button>Add to cart</button>
</a>

</div>

<?php } ?>

</div>


</body>
</html>