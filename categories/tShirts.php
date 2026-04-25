<?php
require "../ecommerce/includes/connection.php";

$stmt = $conn->prepare("SELECT * FROM products WHERE category='tshirts'");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
<title>T-Shirts</title>

<style>

body{
font-family:Arial;
margin:0;
background:#f4f6f9;
}

.header{
background:#0A4174;
color:white;
text-align:center;
padding:20px;
font-size:24px;
font-weight:bold;
}

.container{
display:grid;
grid-template-columns:repeat(4,1fr);
gap:20px;
padding:20px;
}

.card{
background:white;
border-radius:15px;
overflow:hidden;
box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

.card img{
width:100%;
height:260px;
object-fit:cover;
}

.info{
padding:12px;
text-align:center;
}

.price{
color:#0A4174;
font-weight:bold;
margin:8px 0;
}

button{
background:#0A4174;
color:white;
border:none;
padding:8px 15px;
border-radius:8px;
cursor:pointer;
}

</style>

</head>

<body>

<div class="header">T-Shirts</div>

<div class="container">

<?php foreach($products as $p){ ?>

<div class="card">

<img src="../img/<?php echo $p['image']??$p['img']; ?>">

<div class="info">

<h4><?php echo $p['name']; ?></h4>

<div class="price"><?php echo $p['price']; ?> DH</div>

<a href="../ecommerce/cart.php?id=<?php echo $p['id']; ?>">
<button>Add to Cart</button>
</a>

</div>
</div>

<?php } ?>

</div>

</body>
</html>