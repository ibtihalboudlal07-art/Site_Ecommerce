<?php
require "../ecommerce/includes/connection.php";

$stmt = $conn->prepare("SELECT * FROM products WHERE category = 'watches'");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Watches</title>

<style>
body{
font-family:Arial;
background:#f5f6fa;
margin:0;
}

.header{
background:linear-gradient(135deg,#0A4174,#1d5fa8);
color:white;
padding:20px;
text-align:center;
font-size:22px;
font-weight:bold;
}

.container{
display:grid;
grid-template-columns:repeat(4,1fr);
gap:20px;
padding:20px;
}

@media(max-width:900px){
.container{grid-template-columns:repeat(2,1fr);}
}

@media(max-width:500px){
.container{grid-template-columns:1fr;}
}

.card{
background:white;
border-radius:16px;
overflow:hidden;
box-shadow:0 5px 15px rgba(0,0,0,0.1);
transition:0.3s;
}

.card:hover{
transform:translateY(-8px);
}

.card img{
width:100%;
height:300px;
object-fit:cover;
}

.card-body{
padding:12px;
text-align:center;
}

.name{
font-weight:bold;
margin-bottom:5px;
}

.price{
color:#0A4174;
font-weight:bold;
margin:8px 0;
}

button{
width:100%;
padding:10px;
border:none;
border-radius:10px;
background:#0A4174;
color:white;
cursor:pointer;
}

button:hover{
background:#082e55;
}
</style>
</head>

<body>

<div class="header">Watches</div>

<div class="container">

<?php foreach($products as $p){ ?>

<div class="card">
<img src="../img/<?php echo $p['image']; ?>">
<div class="card-body">
<div class="name"><?php echo $p['name']; ?></div>
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