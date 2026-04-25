<style>
body{
font-family:Arial;
background:#eef3f9;
display:flex;
justify-content:center;
align-items:center;
height:100vh;
margin:0;
}

form{
background:white;
padding:25px;
width:350px;
border-radius:12px;
box-shadow:0 10px 30px rgba(0,0,0,0.1);
text-align:center;
}

h2{
color:#0A4174;
margin-bottom:15px;
}

input{
width:100%;
padding:10px;
margin:8px 0;
border:1px solid #ddd;
border-radius:8px;
outline:none;
}

button{
width:100%;
padding:10px;
background:#0A4174;
color:white;
border:none;
border-radius:8px;
cursor:pointer;
font-weight:bold;
}

button:hover{
background:#083055;
}
</style>
<?php

include("../ecommerce/includes/connection.php");

if(isset($_POST['add'])){

$name = $_POST['name'];
$price = $_POST['price'];

/* image upload */
$image = $_FILES['image']['name'];
$tmp = $_FILES['image']['tmp_name'];

move_uploaded_file($tmp, "../img/".$image);

/* INSERT */
$sql = "INSERT INTO products(name,price,img) VALUES(?,?,?)";
$stmt = $conn->prepare($sql);
$stmt->execute([$name,$price,$image]);

/* redirect مهم */
header("Location: products.php");
exit;
}
?>

<form method="POST" enctype="multipart/form-data">

<input type="text" name="name" placeholder="Product name" required><br><br>

<input type="number" name="price" placeholder="Price" required><br><br>

<input type="file" name="image" required><br><br>

<button name="add">Add product</button>

</form>