<?php
session_start();
include("../includes/connection.php");

/* delete product */
if(isset($_GET['id'])){

$id = (int) $_GET['id'];

$stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
$stmt->execute([$id]);

header("Location: products.php");
exit;
}
?>