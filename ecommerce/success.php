<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Order Success</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

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

.box{
text-align:center;
background:white;
padding:40px;
border-radius:15px;
box-shadow:0 10px 30px rgba(0,0,0,0.1);
max-width:400px;
width:90%;
}

.icon{
font-size:60px;
color:green;
}

h2{
color:rgb(30,48,80);
margin-top:15px;
}

p{
color:gray;
}

a{
display:inline-block;
margin-top:15px;
padding:10px 20px;
text-decoration:none;
border-radius:8px;
font-weight:bold;
}

.home{
background:rgb(30,48,80);
color:white;
}

.orders{
background:gray;
color:white;
margin-left:5px;
}

a:hover{
opacity:0.85;
}

</style>

</head>

<body>

<div class="box">

<i class="fa-solid fa-circle-check icon"></i>

<h2>Order Successful</h2>

<p>Thank you for your purchase 🎉</p>
<p>We will contact you soon 📦</p>

<a class="home" href="../index.php">Continue Shopping</a>
<a class="orders" href="../orders.php">My Orders</a>

</div>

</body>
</html>