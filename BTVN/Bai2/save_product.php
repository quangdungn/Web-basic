<?php
$name = $_POST['name'];
$price = $_POST['price'];

$products = include 'products.php';
$newProduct = ['id' => count($products) + 1, 'name' => $name, 'price' => $price];
$products[] = $newProduct;

file_put_contents('products.php', '<?php return ' . var_export($products, true) . ';');
header('Location: table.php');
exit;
