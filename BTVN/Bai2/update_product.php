<?php
$id = $_POST['id'];
$name = $_POST['name'];
$price = $_POST['price'];

$products = include 'products.php';

foreach ($products as &$product) {
    if ($product['id'] == $id) {
        $product['name'] = $name;
        $product['price'] = $price;
        break;
    }
}

file_put_contents('products.php', '<?php return ' . var_export($products, true) . ';');

header('Location: table.php');
exit;
