<h1 class="text-center py-4">CHỈNH SỬA THÔNG TIN CÁ NHÂN</h1>
<?php if (isset($_SESSION['edit_user_status'])) {
    echo '<h5 class="text-primary text-center fw-bolder">' . $_SESSION['edit_user_status'] . '</h5>';
    unset($_SESSION['edit_user_status']);
} ?>
<hr>
<div class="container justify-content-center">
    <div class="row justify-content-center">
        <form id="user-info-form" class="col-10 col-md-6 box p-4" action="/user/edit" method="post">

            <input type="hidden" name="edit-user">
            <div class="form-group mt-3 text-dark fw-bolder">
                <label for="user_name">Tên người dùng:</label>
                <input value="<?= html_escape($user_name) ?? 'Chưa có tên' ?>" type="text" class="form-control" id="user_name" placeholder="Nhập tên người dùng" name="user_name">
            </div>
            <div class="form-group mt-3 text-dark fw-bolder">
                <label for="email">Email:</label>
                <input value="<?= html_escape($email) ?? '' ?>" class="form-control" id="email" placeholder="Nhập email" name="email">
            </div>
            <div class="form-group mt-3 text-dark fw-bolder">
                <label for="phone_number">Số điện thoại</label>
                <input value="<?= html_escape($phone_number) ?? '' ?>" class="form-control" id="phone_number" placeholder="Nhập số điện thoại" name="phone_number">
            </div>
            <div class="form-group mt-3 text-dark fw-bolder">
                <label for="address">Địa chỉ:</label>
                <textarea class="form-control" id="address" placeholder="Nhập địa chỉ" name="address"><?= html_escape($address) ?? '' ?></textarea>
            </div>
            <div id="div-change-password" class="mt-3 d-none">
                <hr class="text-dark">
                <div class="form-group mt-3 text-dark fw-bolder">
                    <label for="password">Mật khẩu hiện tại</label>
                    <input type="password" class="form-control" id="password" placeholder="Nhập mật khẩu hiện tại" name="password">
                </div>
                <div class="form-group mt-3 text-dark fw-bolder">
                    <label for="new_password">Mật khẩu mới</label>
                    <input type="password" class="form-control" id="new_password" placeholder="Mật khẩu mới" name="new_password">
                </div>
                <div class="form-group mt-3 text-dark fw-bolder">
                    <label for="re_new_password">Xác nhận mật khẩu mới</label>
                    <input type="password" class="form-control" id="re_new_password" placeholder="Xác nhận mật khẩu mới" name="re_new_password">
                </div>
                <hr class="text-dark">
            </div>

            <div id="change-password-btn" class="btn mt-3 fw-bold "><i class="fa-solid fa-key"></i></div>
            <div>
                <button type="submit" id="btn-edit-user" class="mt-3 fw-bold btn ">Chỉnh sửa</button>
                <a href="/" type="reset" class="fw-bold mt-3 btn btn-secondary">Hủy</a>
            </div>

        </form>
    </div>



</div>