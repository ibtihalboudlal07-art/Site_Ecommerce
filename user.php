<?php
session_start();

/* CHECK LOGIN */
if(!isset($_SESSION['user'])){
    header("Location:ecommerce/login.php");
    exit;
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>User Profile</title>

<style>
body{
    font-family: Arial;
    background:#BDD8E9;
    margin:0;
    padding:20px;
}

.container{
    max-width:600px;
    margin:auto;
    background:white;
    padding:20px;
    border-radius:15px;
    box-shadow:0 10px 30px rgba(0,0,0,0.1);
}

h1{
    color:#0A4174;
    text-align:center;
}

.info{
    margin-top:20px;
    padding:15px;
    background:#f7fbff;
    border-radius:10px;
}

.info p{
    font-size:16px;
    margin:10px 0;
}

.btn{
    display:block;
    text-align:center;
    padding:12px;
    margin-top:15px;
    border-radius:10px;
    text-decoration:none;
    color:white;
    font-weight:bold;
}


.nav-links a {
    color: #0A4174;
    margin-left: 12px;
    font-size: 18px;
    transition: 0.2s;
}

.nav-links a:hover {
    color: #001D39;
    transform: scale(1.1);
}
.orders{ background:#0A4174; }
.logout{ background:#ff4d4d; }

.orders:hover{ background:#001D39; }
.logout:hover{ background:#cc0000; }

.back{
    display:inline-block;
    margin-bottom:10px;
    text-decoration:none;
    color:#0A4174;
    font-weight:bold;
}
</style>
</head>

<body>

<div class="container">

<a class="back" href="index.php">← Back to shop</a>

<h1>👤 My Profile</h1>

<div class="info">
    <p><b>Name:</b> <?php echo $user['name']; ?></p>
    <p><b>Email:</b> <?php echo $user['email']; ?></p>
</div>

<a class="btn orders" href="orders.php">📦 My Orders</a>
<a class="btn logout" href="ecommerce/loyout.php">🚪 Logout</a>

</div>

</body>
</html>