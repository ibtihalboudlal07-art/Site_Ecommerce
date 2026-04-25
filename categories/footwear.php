<?php
require "../ecommerce/includes/connection.php";

$stmt = $conn->prepare("SELECT * FROM products WHERE category = 'footwear'");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Footwear</title>

<style>
body{font-family:Arial;background:#f5f6fa;margin:0;}
.header{background:#0A4174;color:white;padding:20px;text-align:center;font-size:22px;font-weight:bold;}
.container{display:grid;grid-template-columns:repeat(4,1fr);gap:20px;padding:20px;}
.card{background:white;border-radius:16px;overflow:hidden;}
.card img{width:100%;height:300px;object-fit:cover;}
.card-body{text-align:center;padding:10px;}
.price{color:#0A4174;font-weight:bold;}
button{width:100%;padding:10px;background:#0A4174;color:white;border:none;}
</style>
</head>

<body>

<div class="header">Footwear</div>

<div class="container">

<?php foreach($products as $p){ ?>

<div class="card">
    <img src="../img/<?php echo $p['image']??$p['img']; ?>">
    <div class="card-body">
        <h4><?php echo $p['name']; ?></h4>
        <div class="price"><?php echo $p['price']; ?> DH</div>
        <a href="../ecommerce/cart.php?id=<?php echo $p['id']; ?>">
            <button>Add</button>
        </a>
    </div>
</div>

<?php } ?>

</div>

</body>
</html>