<?php
session_start();
include(__DIR__ . "/../ecommerce/includes/connection.php");
/* include("../includes/connection.php"); */

/* جلب product */
if(isset($_GET['id'])){
$id = (int) $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);
}

/* update product */
if(isset($_POST['update'])){

$id = $_POST['id'];
$name = $_POST['name'];
$price = $_POST['price'];

/* image (اختياري) */
if(!empty($_FILES['image']['name'])){
$image = $_FILES['image']['name'];
move_uploaded_file($_FILES['image']['tmp_name'], "../img/".$image);
}else{
$image = $_POST['old_image'];
}

$stmt = $conn->prepare("UPDATE products SET name=?, price=?, img=? WHERE id=?");
$stmt->execute([$name,$price,$image,$id]);

header("Location: products.php");
exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Edit Product</title>

<style>
body{
font-family:Arial;
background:#eef3f9;
padding:20px;
}

.box{
max-width:400px;
margin:auto;
background:white;
padding:20px;
border-radius:10px;
}

input{
width:100%;
padding:10px;
margin:8px 0;
border:1px solid #ddd;
border-radius:6px;
}

button{
background:green;
color:white;
padding:10px;
border:none;
border-radius:6px;
width:100%;
cursor:pointer;
}
</style>

</head>

<body>

<div class="box">

<h2>Edit Product</h2>

<form method="POST" enctype="multipart/form-data">

<input type="hidden" name="id" value="<?php echo $product['id']; ?>">

<input type="text" name="name" value="<?php echo $product['name']; ?>">

<input type="text" name="price" value="<?php echo $product['price']; ?>">

<input type="file" name="image">

<input type="hidden" name="old_image" value="<?php echo $product['img']; ?>">

<button name="update">Update</button>

</form>

</div>

</body>
</html>