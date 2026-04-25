<?php
session_start();
include("../ecommerce/includes/connection.php");

/* DELETE PRODUCT */
if(isset($_GET['delete'])){
$id = (int) $_GET['delete'];

$stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
$stmt->execute([$id]);

header("Location: products.php");
exit;
}

/* GET PRODUCTS */
$stmt = $conn->query("SELECT * FROM products ORDER BY id DESC");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Admin Products</title>

<style>
body{
font-family:Arial;
background:#eef3f9;
padding:20px;
}

.container{
max-width:900px;
margin:auto;
background:white;
padding:20px;
border-radius:10px;
box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

.header{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:15px;
}

h2{
color:#0A4174;
}

.add{
background:green;
color:white;
padding:8px 12px;
border-radius:6px;
text-decoration:none;
font-size:13px;
}

.item{
display:flex;
align-items:center;
gap:15px;
padding:10px;
border-bottom:1px solid #eee;
}

.item img{
width:60px;
height:60px;
object-fit:cover;
border-radius:8px;
}

.name{
flex:1;
}

.actions a{
margin-right:5px;
padding:5px 8px;
border-radius:5px;
text-decoration:none;
font-size:12px;
color:white;
}

.edit{
background:orange;
}

.delete{
background:red;
}
</style>

</head>

<body>

<div class="container">

<div class="header">
<h2>🛠️ Products Admin</h2>
<a class="add" href="add-product.php">+ Add Product</a>
</div>

<?php foreach($products as $p){ ?>

<div class="item">

<img src="../img/<?php echo $p['img']; ?>">

<div class="name">
<b><?php echo $p['name']; ?></b><br>
<?php echo $p['price']; ?> DH
</div>

<div class="actions">

<a class="edit"
href="edit-product.php?id=<?php echo $p['id']; ?>">
Edit
</a>

<a class="delete"
href="products.php?delete=<?php echo $p['id']; ?>"
onclick="return confirm('Are you sure you want to delete this product?')">
Delete
</a>

</div>

</div>

<?php } ?>

</div>

</body>
</html>