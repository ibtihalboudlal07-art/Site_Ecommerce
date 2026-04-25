<?php
session_start();
require __DIR__ . "/includes/connection.php";

/* SHOW ERRORS */
ini_set('display_errors', 1);
error_reporting(E_ALL);

/* CHECK LOGIN */
if (!isset($_SESSION['user']['id'])) {
    header("Location: ecommerce/login.php");
    exit;
}

/* CHECK CART */
if (empty($_SESSION['cart'])) {
    die("Cart vide");
}

$id_user = $_SESSION['user']['id'];
$total = 0;

/* CALCUL TOTAL */
foreach ($_SESSION['cart'] as $id_product => $qty) {

    $stmt = $conn->prepare("SELECT price FROM products WHERE id = ?");
    $stmt->execute([$id_product]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        $total += $product['price'] * $qty;
    }
}

/* INSERT ORDER */

$stmt = $conn->prepare("
INSERT INTO orders (id_user, total, date_order)
VALUES (?, ?, NOW())
");

if(!$stmt->execute([$id_user, $total])){
    print_r($stmt->errorInfo());
    exit;
}

$order_id = $conn->lastInsertId();

/* INSERT ORDER DETAILS */

foreach($_SESSION['cart'] as $id_product => $qty){

    $stmt2 = $conn->prepare("
    INSERT INTO order_details (id_order, id_product, quantity)
    VALUES (?, ?, ?)
    ");

    if(!$stmt2->execute([$order_id, $id_product, $qty])){
        print_r($stmt2->errorInfo());
        exit;
    }
}

/* CLEAR CART */
unset($_SESSION['cart']);

/* REDIRECT */
header("Location: success.php");
exit;
?>