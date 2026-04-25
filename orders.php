<?php
session_start();
require __DIR__ . "/ecommerce/includes/connection.php";


if (!isset($_SESSION['user']['id'])) {
    header("Location: ecommerce/login.php");
    exit;
}

$id_user = $_SESSION['user']['id'];

$stmt = $conn->prepare("SELECT * FROM orders WHERE id_user=? ORDER BY id DESC");
$stmt->execute([$id_user]);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>My Orders</title>

<style>

body{
font-family:Arial;
background:#eef3f9;
padding:20px;
}

.container{
max-width:650px;
margin:auto;
background:white;
padding:20px;
border-radius:12px;
box-shadow:0 8px 25px rgba(0,0,0,0.08);
}

.top{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:20px;
}

h2{
margin:0;
color:#0A4174;
}

.back{
text-decoration:none;
background:#0A4174;
color:white;
padding:7px 12px;
border-radius:8px;
font-size:13px;
}

.order{
display:flex;
justify-content:space-between;
align-items:center;
padding:15px;
border-bottom:1px solid #eee;
}

.info{
font-size:14px;
}

.date{
font-size:12px;
color:gray;
}

.price{
font-weight:bold;
color:#0A4174;
}

.btn{
background:#0A4174;
color:white;
padding:6px 12px;
border-radius:7px;
text-decoration:none;
font-size:13px;
}

.empty{
text-align:center;
color:gray;
padding:20px;
}

</style>
</head>

<body>

<div class="container">

<div class="top">

<h2>📦 My Orders</h2>

<a class="back" href="index.php">← Shop</a>

</div>

<?php if($stmt->rowCount() > 0){ ?>

<?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)){ ?>

<div class="order">

<div class="info">

<div>
Order #<?php echo $row['id']; ?>
</div>

<div class="price">
<?php echo $row['total']; ?> DH
</div>

<div class="date">
<?php echo $row['date_order']; ?>
</div>

</div>

<a class="btn" href="order_details.php?id=<?php echo $row['id']; ?>">
View
</a>

</div>

<?php } ?>

<?php } else { ?>

<div class="empty">
No orders yet
</div>

<?php } ?>

</div>

</body>
</html>