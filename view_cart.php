<?php
session_start();
require "config.php";

if(!isset($_SESSION['cart'])){
echo "Cart vide";
exit;
}

foreach($_SESSION['cart'] as $id => $qty){

echo "Produit ID: $id - Qty: $qty <br>";

}

echo "<a href='checkout.php'>Valider commande</a>";
?>