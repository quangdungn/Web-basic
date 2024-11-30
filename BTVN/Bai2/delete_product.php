<?php
$id = $_GET['id'];
$products = include 'products.php';

$products = array_filter($products, fn($p) => $p['id'] != $id);
$products = array_values($products);

file_put_contents('products.php', '<?php return ' . var_export($products, true) . ';');
header('Location: table.php');
exit;
