<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Categories</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

body{
margin:0;
font-family:Arial;
background:#f5f6fa;
}

/* header */
.header{
background:linear-gradient(135deg,#0A4174,#1d5fa8);
color:white;
padding:25px;
text-align:center;
font-size:24px;
font-weight:bold;
}

/* grid */
.container{
display:grid;
grid-template-columns:repeat(4,1fr);
gap:20px;
padding:30px;
}

/* responsive */
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

/* card */
.card{
background:white;
border-radius:16px;
text-align:center;
padding:20px;
box-shadow:0 5px 15px rgba(0,0,0,0.1);
transition:0.3s;
cursor:pointer;
}

.card:hover{
transform:translateY(-10px);
box-shadow:0 15px 30px rgba(0,0,0,0.2);
}

/* icon */
.icon{
font-size:40px;
margin-bottom:10px;
color:#0A4174;
}

/* title */
.title{
font-size:18px;
font-weight:bold;
margin-bottom:10px;
}

/* button */
a{
text-decoration:none;
}

.btn{
display:inline-block;
padding:10px 15px;
background:linear-gradient(135deg,#0A4174,#1d5fa8);
color:white;
border-radius:10px;
font-size:14px;
}

.btn:hover{
opacity:0.9;
}

</style>
</head>

<body>

<div class="header"><i class="fa-brands fa-shopify" style="color: rgb(255, 255, 255);"></i> Shop Categories</div>

<div class="container">

<!-- ROSES -->
<div class="card">
<div class="icon">👗</div>
<div class="title">Robes</div>
<a href="robes.php" class="btn">Explore</a>
</div>

<!-- FOOTWEAR -->
<div class="card">
<div class="icon">👟</div>
<div class="title">Footwear</div>
<a href="footwear.php" class="btn">Explore</a>
</div>

<!-- BAGS -->
<div class="card">
<div class="icon">👜</div>
<div class="title">Bags</div>
<a href="bags.php" class="btn">Explore</a>
</div>

<!-- WATCHES -->
<div class="card">
<div class="icon">⌚</div>
<div class="title">Watches</div>
<a href="watches.php" class="btn">Explore</a>
</div>

<!-- T-SHIRTS -->
<div class="card">
<div class="icon">👕</div>
<div class="title">T-Shirts</div>
<a href="tshirts.php" class="btn">Explore</a>
</div>

<!-- JACKETS -->
<div class="card">
<div class="icon">🧥</div>
<div class="title">Jackets</div>
<a href="hoodies.php" class="btn">Explore</a>
</div>

</div>

</body>
</html>