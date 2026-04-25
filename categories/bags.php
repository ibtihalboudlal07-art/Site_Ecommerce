<?php
require "../ecommerce/includes/connection.php";

$stmt = $conn->prepare("SELECT * FROM products WHERE category = 'bags'");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
<title>Bags</title>
<style>
    body{
    font-family: 'Inter', Arial, sans-serif;
    margin:0;
    background:#f5f6fa;
}

/* HEADER */
.header{
    background:linear-gradient(135deg,#0A4174,#1d5fa8);
    color:white;
    padding:20px;
    text-align:center;
    font-size:24px;
    font-weight:bold;
}

/* GRID */
.container{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:20px;
    padding:20px;
}

/* RESPONSIVE */
@media(max-width:900px){
    .container{
        grid-template-columns:repeat(2,1fr);
    }
}

@media(max-width:500px){
    .container{
        grid-template-columns:1fr;
    }
}

/* CARD */
.card{
    background:white;
    border-radius:16px;
    overflow:hidden;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
    transition:0.3s;
    position:relative;
}

.card:hover{
    transform:translateY(-8px);
    box-shadow:0 15px 30px rgba(0,0,0,0.2);
}

/* IMAGE */
.card img{
    width:100%;
    height:300px;
    object-fit:cover;
}

/* BODY */
.card-body, .info{
    padding:12px;
    text-align:center;
}

.name{
    font-size:15px;
    font-weight:bold;
    margin-bottom:5px;
}

.price{
    color:#0A4174;
    font-weight:bold;
    margin:8px 0;
}

/* BUTTON */
button{
    width:100%;
    padding:10px;
    border:none;
    border-radius:10px;
    background:linear-gradient(135deg,#0A4174,#1d5fa8);
    color:white;
    font-weight:bold;
    cursor:pointer;
    transition:0.3s;
}

button:hover{
    opacity:0.9;
}

/* BADGE */
.badge{
    position:absolute;
    top:10px;
    left:10px;
    background:linear-gradient(135deg,#ff416c,#ff4b2b);
    color:white;
    padding:4px 10px;
    font-size:11px;
    border-radius:20px;
}

/* STARS (if you use rating) */
.stars{
    color:#f1c40f;
    font-size:13px;
    margin-bottom:5px;
}
</style>
</head>
<body>

<div class="header">Bags</div>

<div class="container">

<?php foreach($products as $p){ ?>

<div class="card">
<img src="../img/<?php echo $p['image']; ?>">
<div class="card-body">
<div class="name"><?php echo $p['name']; ?></div>
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