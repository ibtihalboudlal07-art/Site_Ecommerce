<?php
require "config.php";

$users = $conn->query("SELECT COUNT(*) FROM users")->fetchColumn();
$products = $conn->query("SELECT COUNT(*) FROM products")->fetchColumn();
$orders = $conn->query("SELECT COUNT(*) FROM orders")->fetchColumn();

echo "Users: $users <br>";
echo "Products: $products <br>";
echo "Orders: $orders <br>";
?>