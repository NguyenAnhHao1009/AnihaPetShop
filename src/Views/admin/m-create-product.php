<marquee behavior="" direction="left" class="p-3">
    <h3> CHÀO MỪNG BẠN ĐẾN VỚI TRANG QUẢN LÝ <b>ANIHA STORE </b></h3>
</marquee>
<div class="container-fluid row justify-content-center ">
    <div class="col-md-6 mb-5 p-5 form-product">
        <h1 class="text-center py-3 fw-bolder" style="color: rgb(255, 0, 102)">THÊM SẢN PHẨM</h1>
        <h5 class="text-danger text-center fw-bolder"><?php echo $_SESSION['add_product_status'] ?? '';
                                                        unset($_SESSION['add_product_status']) ?></h5>
        <hr>
        <form id="create-product-form" action="/admin/product/create" method="POST" enctype="multipart/form-data">
            <div class="h5 form-group">
                <label for="product_name">Tên sản phẩm:</label>
                <input type="text" class="form-control" id="product_name" name="product_name">
            </div>
            <div class="h5 form-group">
                <label for="description">Mô tả:</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>
            <div class="h5 form-group">
                <label for="stock_quantity">Số lượng:</label>
                <input type="number" class="form-control" id="stock_quantity" name="stock_quantity">
            </div>
            <div class=" h5 form-group">
                <label for="category_id">Category:</label>
                <select class="form-control" id="category_id" name="category_id">
                    <option value="1">Chó</option>
                    <option value="2">Mèo</option>
                    <option value="3">Chuột</option>
                    <option value="6">Thỏ</option>
                    <option value="4">Thức ăn</option>
                    <option value="5">Phụ kiện</option>
                    <option value="7">Khác</option>
                </select>
            </div>
            <div class="h5 form-group">
                <label for="unit_price">Đơn giá($):</label>
                <input type="number"    class="form-control" id="unit_price" name="unit_price">
            </div>
            <div class="h5 form-group">
                <label class="btn btn-outline-secondary" for="productImage">Tải ảnh lên</label>
                <input type="file" class="form-control-file d-none" id="productImage" name="product_avatar" accept="image/*">
                <img id="previewImage" src="#" alt="Chưa có ảnh" style="display: none; width: 100px; height: 100px; border-radius: 10%;">
            </div>
            <hr>
            <button type="submit" class="mt-3 btn btn-create-product">Thêm <i class="fa-solid fa-folder-plus fa-lg"></i></button>
            <button type="reset" class="mt-3 btn btn-outline-create-product">Nhập lại <i class="fa-solid fa-rotate-right"></i></button>

        </form>
    </div>
</div>