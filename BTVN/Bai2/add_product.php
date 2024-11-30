<?php include 'header.php'; ?>

<div class="container my-4">
    <h2>Thêm Sản Phẩm Mới</h2>
    <form action="save_product.php" method="post">
        <div class="mb-3">
            <label for="name" class="form-label">Tên sản phẩm</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Giá thành</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
</div>

<?php include 'footer.php'; ?>
