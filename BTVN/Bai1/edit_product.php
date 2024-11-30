<?php
$id = $_GET['id'];
$products = include 'products.php';

$product = null;
foreach ($products as $p) {
    if ($p['id'] == $id) {
        $product = $p;
        break;
    }
}

if (!$product) {
    header('Location: table.php');
    exit;
}
?>

<?php include 'header.php'; ?>

<div class="container my-4">
    <h2>Sửa Sản Phẩm</h2>
    <form action="update_product.php" method="post">
        <input type="hidden" name="id" value="<?= $product['id']; ?>">
        <div class="mb-3">
            <label for="name" class="form-label">Tên sản phẩm</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($product['name']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Giá thành</label>
            <input type="number" class="form-control" id="price" name="price" value="<?= htmlspecialchars($product['price']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
</div>

<?php include 'footer.php'; ?>
