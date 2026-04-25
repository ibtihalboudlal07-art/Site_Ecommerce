<?php
session_start();
require __DIR__ . "/includes/connection.php";

/* INIT CART */
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

/* ADD */
if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;

    header("Location: cart.php");
    exit;
}

/* INC */
if (isset($_GET['inc'])) {
    $id = (int) $_GET['inc'];
    if (isset($_SESSION['cart'][$id])) $_SESSION['cart'][$id]++;

    header("Location: cart.php");
    exit;
}

/* DEC */
if (isset($_GET['dec'])) {
    $id = (int) $_GET['dec'];

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]--;

        if ($_SESSION['cart'][$id] <= 0) {
            unset($_SESSION['cart'][$id]);
        }
    }

    header("Location: cart.php");
    exit;
}

/* REMOVE */
if (isset($_GET['remove'])) {
    $id = (int) $_GET['remove'];
    unset($_SESSION['cart'][$id]);

    header("Location: cart.php");
    exit;
}

/* CLEAR */
if (isset($_GET['clear'])) {
    unset($_SESSION['cart']);

    header("Location: cart.php");
    exit;
}

/* CHECKOUT */
if (isset($_GET['checkout']) && !empty($_SESSION['cart'])) {

    $user_id = $_SESSION['user']['id'] ?? 0;
    $total = 0;

    foreach ($_SESSION['cart'] as $id => $qty) {

        $stmt = $conn->prepare("SELECT price FROM products WHERE id = ?");
        $stmt->execute([$id]);
        $p = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($p) {
            $total += $p['price'] * $qty;
        }
    }

    $stmt = $conn->prepare("
        INSERT INTO orders (id_user, total, date_order)
        VALUES (?, ?, NOW())
    ");
    $stmt->execute([$user_id, $total]);

    unset($_SESSION['cart']);

    header("Location: ../orders.php");
    exit;
}

/* BUILD ITEMS ARRAY (باش مايبقاش error ديال $items) */
$items = [];
$total = 0;

if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $id => $qty) {

        $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        $p = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($p) {
            $p['qty'] = $qty;
            $items[] = $p;

            $total += $p['price'] * $qty;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>My Cart</title>

<style>
body{
font-family:Arial;
background:#BDD8E9;
margin:0;
padding:20px;
}

.container{
max-width:700px;
margin:auto;
background:white;
padding:20px;
border-radius:15px;
box-shadow:0 10px 30px rgba(0,0,0,0.1);
}

.top{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:20px;
}

h3{color:#0A4174;margin:0;}

.back{
text-decoration:none;
background:#0A4174;
color:white;
padding:8px 12px;
border-radius:8px;
font-size:13px;
}

.item{
display:flex;
align-items:center;
gap:12px;
padding:12px;
border-bottom:1px solid #eee;
}

.item img{
width:60px;
height:60px;
object-fit:cover;
border-radius:10px;
}

.name{flex:1;font-size:14px;font-weight:500;}

.price{font-weight:bold;color:#0A4174;}

.total{
margin-top:15px;
padding:15px;
background:#0A4174;
color:white;
border-radius:10px;
display:flex;
justify-content:space-between;
font-size:16px;
font-weight:bold;
}

.controls{
display:flex;
align-items:center;
gap:8px;
}

.qty{font-weight:bold;min-width:20px;text-align:center;}

.btn{
padding:5px 10px;
border-radius:6px;
text-decoration:none;
color:white;
font-weight:bold;
}

.plus{background:#28a745;}
.minus{background:#0A4174;}
.remove{background:#ff4d4d;}

.action-btn{
display:block;
text-align:center;
padding:12px;
margin-top:10px;
border-radius:8px;
color:white;
text-decoration:none;
font-weight:bold;
}

.checkout{background:#28a745;}
.clear{background:#ff4d4d;}

.empty{
text-align:center;
color:gray;
padding:30px;
}
</style>
</head>

<body>

<div class="container">

<div class="top">
<h3>🛒 Cart</h3>
<a class="back" href="../index.php">← Home</a>
</div>

<?php if (!empty($items)): ?>

<?php foreach ($items as $p): ?>

<div class="item">

<img src="../img/<?php echo htmlspecialchars($p['image']); ?>"
     onerror="this.src='../img/default.jfif'">

<div class="name"><?php echo htmlspecialchars($p['name']); ?></div>

<div class="price"><?php echo $p['price'] * $p['qty']; ?> DH</div>

<div class="controls">
<a class="btn minus" href="cart.php?dec=<?php echo $p['id']; ?>">-</a>
<span class="qty"><?php echo $p['qty']; ?></span>
<a class="btn plus" href="cart.php?inc=<?php echo $p['id']; ?>">+</a>
<a class="btn remove" href="cart.php?remove=<?php echo $p['id']; ?>">🗑</a>
</div>

</div>

<?php endforeach; ?>

<div class="total">
<span>Total</span>
<span><?php echo $total; ?> DH</span>
</div>

<a class="action-btn checkout" href="checkout.php?checkout=1">Checkout</a>
<a class="action-btn clear" href="cart.php?clear=1">Clear Cart</a>

<?php else: ?>

<div class="empty">Cart empty 🛒</div>

<?php endif; ?>

</div>

</body>
</html>