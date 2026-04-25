<?php $base = "/Mysite/"; ?>
<?php
require "../ecommerce/includes/connection.php";

$stmt = $conn->prepare("SELECT * FROM products WHERE category = 'robes'");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Robes</title>

<style>
body{
font-family:Arial;
background:#f5f6fa;
margin:0;
}

/* HEADER */
.header{
background:linear-gradient(135deg,#0A4174,#1d5fa8);
color:white;
padding:20px;
text-align:center;
font-size:22px;
font-weight:bold;
}

/* GRID */
.container{
display:grid;
grid-template-columns:repeat(4,1fr);
gap:20px;
padding:20px;
}

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
height:490px;
object-fit:cover;
}

/* BODY */
.card-body{
padding:12px;
text-align:center;
}

.name{
font-size:14px;
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
</style>

</head>

<body>

<div class="header">Robes Collection</div>

<div class="container">

<?php foreach($products as $p){ ?>

<div class="card">
    <div class="badge">NEW</div>

   <img src="<?php echo $base . 'img/' . $p['image']?? $p['img']; ?>">

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