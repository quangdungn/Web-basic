<?php include 'header.php'; ?>
<?php $products = include 'products.php'; ?>

<div class="container my-4">
    <h2 class="text-center">Danh Sách Sản Phẩm</h2>
    <a href="add_product.php" class="btn btn-success mb-3">Thêm mới</a>
    <?php if (empty($products)): ?>
        <p class="text-center">Không có sản phẩm nào.</p>
    <?php else: ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Giá thành</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= htmlspecialchars($product['name']); ?></td>
                        <td><?= htmlspecialchars($product['price']); ?> VND</td>
                        <td><a href="edit_product.php?id=<?= $product['id']; ?>" class="text-primary"><i class="bi bi-pencil"></i></a></td>
                        <td><a href="delete_product.php?id=<?= $product['id']; ?>" class="text-danger" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?');"><i class="bi bi-trash"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
