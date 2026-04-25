<?php
session_start();

if(!isset($_SESSION['user'])){
header("Location: login.php");
exit;
}

if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])){
die("Cart vide");
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Payment</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

body{
font-family:Arial;
background:#f5f7fb;
margin:0;
display:flex;
justify-content:center;
align-items:center;
height:100vh;
}

.container{
width:420px;
background:white;
padding:25px;
border-radius:15px;
box-shadow:0 10px 30px rgba(0,0,0,0.1);
}

h2{
text-align:center;
color:#0A4174;
margin-bottom:20px;
}

.option{
border:1px solid #ddd;
padding:12px;
border-radius:10px;
margin:10px 0;
cursor:pointer;
display:flex;
align-items:center;
justify-content:space-between;
transition:0.3s;
}

.option:hover{
border-color:#0A4174;
background:#f0f6ff;
}

.option i{
color:#0A4174;
margin-right:10px;
}

.btn{
width:100%;
padding:12px;
background:#0A4174;
color:white;
border:none;
border-radius:10px;
margin-top:15px;
cursor:pointer;
font-weight:bold;
}

.btn:hover{
background:#001d39;
}

.small{
font-size:12px;
color:gray;
text-align:center;
margin-top:10px;
}

</style>

</head>

<body>

<div class="container">

<h2>💳 Payment Method</h2>

<form action="checkout.php" method="POST">

<!-- Cash on delivery -->
<label class="option">
<div>
<i class="fa-solid fa-truck"></i>
Cash on Delivery
</div>
<input type="radio" name="payment" value="cod" checked>
</label>

<!-- Card -->
<label class="option">
<div>
<i class="fa-solid fa-credit-card"></i>
Credit / Debit Card
</div>
<input type="radio" name="payment" value="card">
</label>

<!-- PayPal -->
<label class="option">
<div>
<i class="fa-brands fa-paypal"></i>
PayPal
</div>
<input type="radio" name="payment" value="paypal">
</label>

<button class="btn" type="submit">Confirm Order</button>

</form>

<div class="small">
Secure checkout • Like Jumia / Shein style
</div>

</div>

</body>
</html>