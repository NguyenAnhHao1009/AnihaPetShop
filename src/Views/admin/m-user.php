<?php
if (!isset($_SESSION['admin_id'])) {
    redirect('/');
}
?>

<div class="container-fluid px-2">
    <h1 class="pt-2 text-center fw-bolder">DANH SÁCH NGƯỜI DÙNG</h1>

    <div class="row">
        <form id='admin-search-form' class="row justify-content-end" action="/admin/user" method='get'>
            <div class=" btn-group col-12 col-sm-6 col-md-4 col-lg-3 row">
                <input name="key" class=" col-9 text-truncate" type="text" placeholder="Nhập tên người dùng">
                <button class="btn col-3">Tìm</button>
            </div>
        </form>
    </div>
    <hr>
    <?php
    if (empty($users) || !isset($users)) {
        echo '<div class="py-3 col-12 text-secondary text-center"><h2>Không tìm thấy thông tin khách hàng</h2></div>';
    } else {
    ?>
        <table id="myTable" class="admin-table container-fluid text-center mb-4">
            <tr>
                <th>Mã KH</th>
                <th onclick="sortTable(1)">Tên <i style="cursor: pointer" class="btn-sort fa-solid fa-sort fa-lg"></th>
                <th onclick="sortTable(2)">Email <i style="cursor: pointer" class="btn-sort fa-solid fa-sort fa-lg"></i></th>
                <th>Số điện thoại </th>
                <th onclick="sortTable(4)">Địa chỉ <i style="cursor: pointer" class="btn-sort fa-solid fa-sort"></i></th>
                <th onclick="sortTable(5)">Vai trò <i style="cursor: pointer" class="btn-sort fa-solid fa-sort"></i></th>
            </tr>
            <?php foreach ($users as $us) : ?>

                <tr class="info">
                    <td><?= html_escape($us['user_id']) ?? '' ?></td>
                    <td><?= html_escape($us['user_name']) ?? '' ?></td>
                    <td><?= html_escape($us['email']) ?? '' ?></td>
                    <td><?= html_escape($us['phone_number']) ?? '' ?></td>
                    <td><?= html_escape($us['address']) ?? '' ?></td>
                    <td><?php
                        if ($us['is_admin'] == 1) echo 'Quản lý';
                        else if ($us['is_admin'] == 0) echo 'Khách hàng';
                        else echo 'Không xác định';
                        ?></td>

                </tr>
            <?php endforeach; ?>
        </table>
    <?php } ?>
</div>