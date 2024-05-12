<?php
if (!isset($_SESSION['admin_id'])) {
    redirect('index.php?admin_id');
}
?>

<div class="container-fluid my-3 row justify-content-center">
    <h1 class="pt-2 text-center fw-bolder col-12">DANH SÁCH ĐƠN HÀNG</h1>
    <div class="row btn-group justify-content-center  col-5 col-md-3 col-lg-2 py-2">
        <a href="/admin/order?status=wait" class="col-4 fw-bolder btn btn-outline-primary"><i class="py-1 fa-solid fa-hourglass-start fa-beat"></i></a>
        <a href="/admin/order?status=finish" class="col-4 fw-bolder btn btn-outline-success"><i class="py-1 fa-solid fa-clipboard-check"></i></a>
        <a href="/admin/order?status=cancel" class="col-4 fw-bolder btn btn-outline-danger"><i class="py-1 fa-regular fa-file-excel"></i></a>
    </div>
    <?php
    if (isset($_SESSION['accept_order'])) {
        echo '<h5 class="text-center text-success fw-bolder">' . $_SESSION['accept_order'] . '</h5>';
        unset($_SESSION['accept_order']);
    } ?>
    <hr>
    <div class="container-fluid">
        <form id='admin-search-form' class="row justify-content-start" action="/admin/order" method='post'>
            <div class="btn-group group col-12 col-sm-6 col-md-4 col-lg-3 row ">
                <button class="col-3 btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                <input name="order_id" class="col-9 text-truncate" type="text" placeholder="Nhập mã đơn hàng">
            </div>
        </form>
    </div>

    <?php
    if (empty($orders) || !isset($orders)) {
        echo '<div class="py-3 col-12 text-secondary text-center"><h3>Không có đơn hàng nào để hiển thị</h1></div>';
    } else {
    ?>



        <table id="myTable" class="admin-table container-fluid text-center">
            <tr>
                <th>Mã hóa đơn </th>
                <th>Tên khách hàng </th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>

                <th>Trạng thái</th>
                <th>Chi tiết</th>

            </tr>



            <?php
            $prevOrderId = null;

            foreach ($orders as $od) : ?>
                <?php
                if ($od['status'] == -1) {
                    continue;
                }

                if ($od['order_id'] !== $prevOrderId) {
                ?>

                    <tr class="info">
                        <td>
                            <?= html_escape($od['order_id']) ?>
                        </td>
                        <td>
                            <?= html_escape($od['user_name']) ?>
                        </td>
                        <td>
                            <?= html_escape($od['order_phone']) ?>
                        </td>
                        <td>
                            <?= html_escape($od['order_address']) ?>
                        </td>

                        <td>
                            <?php
                            if ($od['status'] == 1) echo '<a class="text-success">Đã duyệt</a>';
                            else if ($od['status'] == -2) echo '<a class="text-secondary">Khách đã hủy</a>';
                            else echo '<a class="text-danger">Chờ duyệt</a>';
                            ?>
                        </td>

                        <td>
                            <a class="btn btn-primary" href="/admin/order_detail?id=<?= html_escape($od['order_id']) ?>"><i class="fa-solid fa-eye"></i></a>
                        </td>


                    </tr>
                <?php
                }

                ?>

            <?php

                $prevOrderId = $od['order_id'];
            endforeach; ?>
        </table>
    <?php } ?>
</div>