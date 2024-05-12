<h1 class="text-center py-4">CÁC ĐƠN HÀNG ĐÃ ĐẶT</h1>

<?php
if (isset($_SESSION['remove-order-status'])) {
    echo '<h4 class="text-center text-info">' . $_SESSION['remove-order-status'] . '</h4>';
    unset($_SESSION['remove-order-status']);
}

if (isset($_SESSION['add-order-status'])) {
    echo '<h4 class="text-center text-info">' . $_SESSION['add-order-status'] . '</h4>';
    unset($_SESSION['add-order-status']);
}

?>
<div class="text-start mx-2">
        <a class="btn btn-add-to-cart fw-bold fs-4" href="/user/cart"><i class="fa-solid fa-angle-left"></i></a>
    </div>
<hr>
<?php
if (empty($cart_finish) || !isset($cart_finish)) {
    echo '<div class="py-3 col-12 text-secondary text-center"><h2>Không có đơn hàng nào để hiển thị</h2></div>';
} else {
?>
    <div class="px-3">
        <table id="myTable" class="admin-table container-fluid text-center mb-5 table-cart">
            <tr>
                <th>Mã đơn hàng </th>
                <th>Ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Số tiền</th>
                <th>Trạng thái</th>
                <th>Tiến độ</th>
                <th>In ĐH</th>

            </tr>


            <?php
            $prevOrderId = null;
            foreach ($cart_finish as $od) : ?>
                <?php
                if($od['status']==-1){
                    continue;
                }

                if ($od['order_id'] !== $prevOrderId) {
                    echo '<tr><td class="bg-light" colspan="9">' . '</td></tr>';
                }

                ?>
                <tr class="info">
                    <?php
                    if ($od['order_id'] !== $prevOrderId) {
                        echo '<td class="fw-bolder">' . $od['order_id'] ?? '';
                    } else {
                        echo '<td>';
                    }
                    ?></td>
                    <td class="p-1"><a class="product-name" href="/product_detail?id=<?= $od['product_id'] ?? -1 ?>"><img style="border-radius: 3%" width="100px" class="img-fluid" src="/uploads/<?= html_escape($od['product_avatar']) ?>" alt="Ảnh đang cập nhật"></a></td>

                    <td> <a class="product-name" href="/product_detail?id=<?=  $od['product_id'] ?? -1 ?>"><?= html_escape($od['product_name'])  ?></a></td>
                    <td><?= html_escape($od['quantity']) ?></td>
                    <td><?= html_escape($od['unit_price']) ?></td>
                    <td><?= html_escape($od['quantity'] * $od['unit_price']) ?></td>

                    <td>
                        <?php
                        if ($od['order_id'] !== $prevOrderId) {
                            if ($od['status'] == 1) echo '<a class="text-success">Đã duyệt</a>';
                            else if ($od['status'] == 0) echo '<a class="text-primary">Chờ duyệt</a>';
                            else if($od['status'] == -2) echo '<a class="text-danger">Đã hủy</a>';;
                        } else {
                            echo '';
                        }
                        ?>
                    </td>

                    <td>
                        <?php
                        if ($od['order_id'] !== $prevOrderId) {
                            if ($od['status'] == 0){?>
                                <form action="/user/cart/rm_order" method="get">
                                    <input type="hidden" name="id" value="<?=html_escape($od['order_id']) ?>">
                                    <button class="btn btn-remove btn-user-cancel-order" type="submit">Hủy</button>
                                </form>
                            <?php }
                            else if ($od['status'] == -2)
                                echo '<a class="fw-bolder">Chờ xóa đơn hàng</a>';
                            else if($od['status']==1)
                                echo '<a class="fw-bolder">Đã gửi hàng</a>';
                        } else {
                            echo '';
                        }
                        ?>
                    </td>

                    <td>
                        <?php
                        if ($od['order_id'] !== $prevOrderId) {
                            if ($od['status'] == 0)
                                echo '<p class="text-secondary">Chưa thể in</p>';
                            if ($od['status'] == -2)
                                echo '<p class="text-secondary">Không thể in</p>';
                            if($od['status'] == 1)
                                echo '<a href="/user/cart/print?id='.html_escape($od['order_id']).'" class="btn btn-outline-primary"><i class="fa-solid fa-print"></i></a>';
                        } else {
                            echo '';
                        }
                        ?>
                    </td>

                </tr>
            <?php
                $prevOrderId = $od['order_id'];
            endforeach; ?>
        </table>
    <?php } ?>
    </div>