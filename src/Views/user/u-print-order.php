<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>
    Aniha Store
  </title>

  <link rel="shortcut icon" href="/img/logo.png" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="/css/style.css" />
</head>

<body>
    <div class="container py-5 ">
        <h5 class='text-center fw-bolder my-1'><b>HÓA ĐƠN ANIHA STORE</b></h5>
        <h1 class='text-center pb-4'>Mã hóa đơn: <?= html_escape($order_print[0]['order_id'])?></h5>
       
        <div class="container ">
            <table class='fw-lighter'>
                <tr>
                    <td class='fw-bolder'>
                        Tên khách hàng
                    </td>
                    <td>:</td>
                    <td>
                        <?= html_escape($owner['user_name'])?>
                    </td>
                </tr>
                <tr>
                <td class='fw-bolder'>Thời gian </td>
                    <td>:</td>
                    <td> <?= html_escape($order_date)?></td>
                </tr>
                <tr>
                <td class='fw-bolder'>Địa chỉ</td>
                    <td>:</td>
                    <td> <?= html_escape($order_print[0]['order_address'])?></td>
                </tr>
                <tr>
                <td class='fw-bolder'>Số điện thoại</td>
                    <td>:</td>
                    <td> <?= html_escape($order_print[0]['order_phone'])?></td>
                </tr>
            </table>
            <hr>
            <div class="container">
                <table class="table table-bordered">
                    <tr>
                        <th>STT</th>
                        <th>Sản Phẩm</th>
                        <th>Số lượng</th>
                        <th>Đơn giá ($)</th>
                        <th>Thành tiền ($)</th>
                    </tr>
                    <?php
                    $stt=1;
                    $total=0;
                    foreach($order_print as $order):
                        
                    ?>
                    <tr>
                        <td><?= $stt++?></td>
                        <td><?= html_escape($order['product_name'])?></td>
                        <td><?= html_escape($order['quantity'])?></td>
                        <td><?= html_escape($order['unit_price'])?></td>
                        <td><?= html_escape($order['quantity']*$order['unit_price'])?></td>
                    </tr>
                    </tr>
                    <?php
                    $total += $order['quantity']*$order['unit_price'];

                    endforeach;
                    ?>
                </table>
                <h4 class="px-5 text-end text-primary">Tổng tiền: <?= $total .' $'?></h5>
            </div>
<hr>
            <h5 class="fw-bolder text-center px-5 mx-5">Cảm ơn quý khách đã ủng hộ!</h5>
        </div>
    </div>
</body>