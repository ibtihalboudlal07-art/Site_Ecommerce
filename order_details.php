<?php
session_start();
require __DIR__ . "/ecommerce/includes/connection.php";

/* LOGIN CHECK */
if (!isset($_SESSION['user']['id'])) {
    header("Location: ecommerce/login.php");
    exit;
}

/* CHECK ID */
if (!isset($_GET['id'])) {
    die("Order not found");
}

$id_order = (int) $_GET['id'];
$user_id = $_SESSION['user']['id'];

/* VERIFY OWNERSHIP */
$check = $conn->prepare("SELECT id FROM orders WHERE id = ? AND id_user = ?");
$check->execute([$id_order, $user_id]);

if ($check->rowCount() == 0) {
    die("Unauthorized access");
}

/* GET ITEMS */
$stmt = $conn->prepare("
    SELECT od.quantity, p.name, p.price, p.image
    FROM order_details od
    JOIN products p ON od.id_product = p.id
    WHERE od.id_order = ?
");

$stmt->execute([$id_order]);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total = 0;


?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Order Details</title>

<style>
body{
    font-family: Arial;
    background:#eef3f9;
    padding:20px;
}

.container{
    max-width:700px;
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
    margin-bottom:15px;
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

.item{
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:12px;
    border-bottom:1px solid #eee;
}

.item img{
    width:50px;
    height:50px;
    object-fit:cover;
    border-radius:8px;
    margin-right:10px;
}

.left{
    display:flex;
    align-items:center;
    gap:10px;
}

.name{
    font-size:14px;
    font-weight:bold;
}

.qty{
    font-size:13px;
    color:gray;
}

.price{
    font-weight:bold;
    color:#0A4174;
}

.total{
    margin-top:15px;
    padding:12px;
    background:#0A4174;
    color:white;
    border-radius:10px;
    display:flex;
    justify-content:space-between;
    font-size:15px;
    font-weight:bold;
}
</style>

</head>

<body>

<div class="container">

<div class="top">
    <h2>📦 Order #<?php echo $id_order; ?></h2>
    <a class="back" href="orders.php">← Back</a>
</div>

<?php if(count($items) > 0){ ?>

    <?php foreach($items as $row){ 

        $subtotal = $row['price'] * $row['quantity'];
        $total += $subtotal;
    ?>

    <div class="item">

        <div class="left">
            <img src="img/<?php echo htmlspecialchars($row['image']); ?>">
            <div>
                <div class="name"><?php echo $row['name']; ?></div>
                <div class="qty">Qty: <?php echo $row['quantity']; ?></div>
            </div>
        </div>

        <div class="price">
            <?php echo $subtotal; ?> DH
        </div>

    </div>

    <?php } ?>

    <div class="total">
        <span>Total</span>
        <span><?php echo $total; ?> DH</span>
    </div>

<?php } else { ?>

    <p style="text-align:center;color:gray;">No items found</p>

<?php } ?>

</div>

</body>
</html>