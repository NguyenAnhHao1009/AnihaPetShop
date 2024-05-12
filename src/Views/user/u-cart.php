<?php
?>
<div class="container-fluid">
    <h1 class="pt-4 text-center">GIỎ HÀNG CỦA BẠN </h1>
    <?php
    if (isset($_SESSION['edit_quantity_status'])) {
        echo $_SESSION['edit_quantity_status'];
        unset($_SESSION['edit_quantity_status']);
    }
    ?>
    <?php
    if (isset($_SESSION['remove-product-status'])) {
        echo '<h4 class="text-center text-primary">' . $_SESSION['remove-product-status'] . '</h4>';
        unset($_SESSION['remove-product-status']);
    }

    if (isset($_SESSION['add-to-cart-status'])) {
        echo '<h4 class="text-center text-success">' . $_SESSION['add-to-cart-status'] . '</h4>';
        unset($_SESSION['add-to-cart-status']);
    }


    ?>
    <div class="text-end">
        <a class="btn btn-add-to-cart fw-bold fs-4" href="/user/cart/finish"><i class="fa-solid fa-file-invoice"></i></a>
    </div>
    <hr>
    <?php
    if (empty($cart_info)) {
        echo '<h2 class="text-center text-secondary py-2">Không có sản phẩm nào trong giỏ hàng</h2>';
    } else {
        $order_id = $cart_info[0]['order_id'] ?? '';
    ?>
        <h4 style="color: rgb(255, 0, 102)"><i class="fa-solid fa-cart-shopping pb-4"></i> Mã Đơn Hàng: <?= $order_id ?> </h4>
        <table class=" admin-table container-fluid text-center table-cart">
            <tr>
                <th>STT</th>
                <th>Ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Đơn giá ($)</th>
                <th>Số tiền ($)</th>
                <th>Xóa</th>
            </tr>
            <?php
            $stt = 1;
            $total = 0;
            foreach ($cart_info as $odd) : ?>
                <tr>
                    <td><?= $stt++ ?></td>
                    <td class="p-1" style="width: 100px"><a href="/product_detail?id=<?= html_escape($odd['product_id']) ?>"><img width="100%" class="img-fluid rounded" src="/uploads/<?= $odd['product_avatar'] ?>" alt="Chưa cập nhật"></a> </td>
                    <td><a class="product-name" href="/product_detail?id=<?= html_escape($odd['product_id'])  ?>"><?= html_escape($odd['product_name'])  ?></a></td>
                    <td>
                        <form method="post" action="/user/cart/edit" id="edit-quantity">
                            <input type="hidden" name="order_id" value="<?= $order_id ?>">
                            <input type="hidden" name="product_id" value="<?= html_escape($odd['product_id']) ?>">
                            <input oninput="showEditButton(this)" name="new_quantity" class="form-control d-inline-block input-change-quantity-in-cart" style="width: 60px" type="number" value="<?= $odd['quantity'] ?>">
                            <input type="hidden" name="old_quantity" value="<?= html_escape($odd['quantity']) ?>">
                            <button class="d-none btn-change-quantity-in-cart">
                                <i class="fa-solid fa-pencil"></i>
                            </button>
                        </form>

                    </td>
                    <td><?= html_escape($odd['unit_price'])  ?></td>
                    <td><?= html_escape($odd['total_detail']) ?></td>
                    <td>
                        <form action="/user/cart/remove" method="get">
                            <input type="hidden" name="order_id" value="<?= html_escape($odd['order_id']) ?>">
                            <input type="hidden" name="rm_product_id" value="<?= html_escape($odd['product_id']) ?>">
                            <button class="btn btn-remove btn-remove-product-from-cart" type="submit"><i class=" fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>

            <?php
                $total += $odd['total_detail'];
            endforeach; ?>

        </table>

        <div class="py-3">
            <b class="h5 text-primary border border-1 rounded p-2 text-bolder">Tổng tiền: <?= $total . ' $' ?></b>
            <hr>
            <!-- Button trigger modal -->
            <button type="button" class="btn fw-bolder btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Đặt hàng
            </button>
        </div>
        <?php

        ?>
</div>


<?php
    }
?>

<!-- Modal xác nhận đặt hàng-->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-bolder " id="staticBackdropLabel">XÁC NHẬN ĐẶT HÀNG</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="send-cart-form" action="/user/cart/send" method="post">
                    <input type="hidden" name="id" value="<?= html_escape($order_id) ?>">
                    <div class="form-group">
                        <label class="fw-bolder" for="order_phone">Số điện thoại nhận hàng:</label>
                        <input class="form-control" id="order_phone" type="text" name="order_phone" required placeholder="Số điện thoại">
                    </div>
                    <div class="form-group my-2">
                        <label class="fw-bolder" for="order_address">Địa chỉ nhận hàng:</label>
                        <input class="form-control" id="order_address" type="text" name="order_address" required placeholder="Địa chỉ nhận">
                    </div>

                    <div class="form-group my-2">
                        <label class="fw-bolder" for="">Phương thức thanh toán: </label><span class="text-secondary"> Chức năng đang phát triển</span>
                        <select class="form-control" name="" id="">
                            <option value="">Thanh toán khi nhận hàng</option>
                            <option value="">Chuyển khoản trực tuyến</option>
                        </select>
                    </div>
                    

                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Hủy</button>
                <button form="send-cart-form" class="btn btn-primary btn-user-submit-cart">Xác nhận đặt hàng</button>
            </div>
        </div>
    </div>
</div>