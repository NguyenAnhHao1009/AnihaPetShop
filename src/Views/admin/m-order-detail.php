<?php


if (empty($odds)) {
    redirect('/error');
} else { ?>

    <h2 class="text-center p-3">CHI TIẾT ĐƠN HÀNG </h2>

    <div class="text-start mx-2">
        <a class="btn-back btn fw-bold fs-4" href="/admin/order"><i class="fa-solid fa-angle-left"></i></a>
    </div>

    <div class="container-fluid py-1">
        <div class="row">
            <div class="col-lg-9 ">
                <div class=" border border-1 p-3 mb-2">
                    <div class="row justify-content-between">
                        <span class="fw-bolder  col-12 col-sm-4">ID tài khoản: <?= html_escape($odds[0]['user_id']) ?></span>
                        <span class="col-4"><i class="fa-solid fa-address-book "></i> <?= html_escape($odds[0]['user_name']) ?></span>
                        <span class="col-4 "><i class="fa-solid fa-square-phone "></i> <?= html_escape($odds[0]['phone_number']) ?></span>
                    </div>
                </div>
                <div class=" border border-1 p-3">
                    <table class="table  table-hover table-order-detail">
                        <tr>
                            <th>#</th>
                            <th >SP</th>
                            <th >SL</th>
                            <th >ĐG ($)</th>
                            <th >TT ($)</th>
                        </tr>
                        <?php
                        $sum = 0;
                        $count = 1;
                        foreach ($odds as $odd) :
                        ?>
                            <tr>
                                <td><?=$count++?></td>
                                <td><a class="text-primary" href="/product_detail?id=<?= html_escape($odd['product_id']) ?>"><?= html_escape($odd['product_name']) ?></a></td>
                                <td><?= html_escape($odd['quantity']) ?></td>
                                <td><?= html_escape($odd['unit_price']) ?></td>
                                <td><?= html_escape($odd['quantity'] * $odd['unit_price']) ?></td>
                            </tr>

                        <?php
                            $sum += ($odd['quantity'] * $odd['unit_price']);
                        endforeach;
                        ?>
                    </table>
                </div>

            </div>
            <div class="col-lg-3 my-2 my-lg-0">
                <div class="border border-1 p-3">
                    <b class="text-primary">Mã đơn hàng: <?= html_escape($odds[0]['order_id'])?></b>
                    <div><b>Thời gian đặt:</b> <span class="text-secondary"><?= html_escape($odds[0]['order_date'])?></span> </div>
                    <p><b>Trạng thái:</b> 
                    <?php
                        if($odds[0]['status']== -2){?>
                            <span class="text-secondary">Đã hủy </span>
                            <form action="/admin/order/rm_order" method="get">
                                <input type="hidden" name="id" value="<?= $odds[0]['order_id'] ?>">
                                <button class="btn-admin-remove-order btn btn-outline-warning" type="submit">Xóa đơn hàng</button>
                            </form>
                        <?php
                        }
                        if($odds[0]['status']== 0){?>
                           <span class="text-danger">Chờ duyệt </span>
                            <form action="/admin/order/accept" method="get">
                                <input type="hidden" name="id" value="<?= $odds[0]['order_id'] ?>">
                                <button class="btn btn-admin-accept-order btn-outline-success" type="submit">Duyệt đơn hàng</button>
                            </form>
                        <?php
                        }
                        if($odds[0]['status']== 1){
                            echo '<span class="text-success">Đã duyệt</span>';
                        }

                    
                    ?>
                
                    </p>
                    <hr>
                    <div class="text-secondary">
                        <div><i class="fa-solid fa-user"></i> <?= html_escape($odds[0]['user_name']) ?></div>
                        <div><i class="fa-solid fa-phone "></i> <?= html_escape($odds[0]['order_phone']) ?></div>
                        <div><i class="fa-solid fa-location-dot"></i> <?= html_escape($odds[0]['order_address']) ?></div>
                        <div><i class="fa-solid fa-envelope"></i> <?= html_escape($odds[0]['email']) ?></div>
                    </div>
                    <hr>
                    <div class="text-start py-2 ">
                        <b class="border border-1 rounded p-2 text-primary">Tổng tiền: <?= html_escape($sum) ?> $</b>
                    </div>
                    
                </div>
            </div>
        </div>

    </div>

<?php


}

?>