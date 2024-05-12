<?php

?>

<marquee behavior="" direction="left" class="p-3">
    <h3>CHÀO MỪNG BẠN ĐẾN VỚI TRANG QUẢN LÝ <b>ANIHA STORE </b></h3>
</marquee>
<div class="container-fluid row justify-content-center ">
    <div class="col-md-6 mb-5 p-5 form-product">
        <h1 class="text-center py-3 fw-bolder" style="color: rgb(255, 0, 102)">CHỈNH SỬA SẢN PHẨM</h1>
        <h5 class="text-danger text-center fw-bolder"><?php echo $_SESSION['edit_product_status'] ?? '';
                                                        unset($_SESSION['edit_product_status']) ?></h5>
        <hr>
        <form id="edit-product-form" action="/admin/product/edit" method="POST" enctype="multipart/form-data">
            <input class="d-none" name="product_id" type="text" value="<?= html_escape($product['product_id']) ?? '-1' ?>">
            <input class="d-none" name="old_product_avatar" type="text" value="<?= html_escape($product['product_avatar']) ?>">
            <div class="h5 form-group">
                <label for="product_name">Tên sản phẩm:</label>
                <input value="<?= html_escape($product['product_name']) ; ?>" type="text" class="form-control" id="product_name" name="product_name">
            </div>
            <div class="h5 form-group">
                <label for="description">Mô tả:</label>
                <textarea class="form-control" id="description" name="description"><?= html_escape($product['description']) ; ?></textarea>
            </div>
            <div class="h5 form-group">
                <label for="stock_quantity">Số lượng:</label>
                <input type="number" value='<?= html_escape($product['stock_quantity']) ; ?>' class="form-control" id="stock_quantity" name="stock_quantity">
            </div>
            <div class=" h5 form-group">
                <label for="category_id">Category:</label>
                <select class="form-control" id="category_id" name="category_id">
                    <option value="1" <?php if ($product['category_id'] == 1) echo 'selected'; ?>>Chó</option>
                    <option value="2" <?php if ($product['category_id'] == 2) echo 'selected'; ?>>Mèo</option>
                    <option value="3" <?php if ($product['category_id'] == 3) echo 'selected'; ?>>Chuột</option>
                    <option value="6" <?php if ($product['category_id'] == 6) echo 'selected'; ?>>Thỏ</option>
                    <option value="4" <?php if ($product['category_id'] == 4) echo 'selected'; ?>>Thức ăn</option>
                    <option value="5" <?php if ($product['category_id'] == 5) echo 'selected'; ?>>Phụ kiện</option>
                    <option value="7" <?php if ($product['category_id'] == 7) echo 'selected'; ?>>Khác</option>
                </select>
            </div>
            <div class="h5 form-group">
                <label for="unit_price">Đơn giá($):</label>
                <input value="<?= html_escape($product['unit_price']); ?>" type="number" min="1" class="form-control" id="unit_price" name="unit_price">
            </div>
            <div class="h5 form-group">
                <label class="btn btn-outline-secondary" for="productImage">Tải ảnh lên</label>
                <input type="file" class="form-control-file d-none" id="productImage" name="product_avatar" accept="image/*">
                <img id="previewImage" src="/uploads/<?= html_escape($product['product_avatar'])?> " alt="Ảnh chờ cập nhật" style=" width: 100px; height: 100px; border-radius: 10%;">
            </div>
            <hr>
            <button type="submit" class="mt-3 btn btn-create-product">Sửa <i class="fa-solid fa-folder-plus fa-lg"></i></button>
            <a href="/admin/product" class="mt-3 btn btn-outline-create-product">Hủy</i></a>
        </form>
    </div>
</div>