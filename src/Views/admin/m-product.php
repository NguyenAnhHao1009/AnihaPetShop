<?php
if (!isset($_SESSION['admin_id'])) {
    redirect('/');
}

?>

<div class="container-fluid px-2">
    <h1 class="pt-4 text-center fw-bolder">QUẢN LÝ SẢN PHẨM</h1>
    <h5 class="text-success text-center fw-bolder"><?php echo $_SESSION['add_product_status'] ?? '';
                                                    unset($_SESSION['add_product_status']) ?></h5>

    <?php echo $_SESSION['delete_product_status'] ?? '';
    unset($_SESSION['delete_product_status']) ?>
    <?php echo $_SESSION['edit_product_status'] ?? '';
    unset($_SESSION['edit_product_status']) ?>
    <div class="row">
        <form id='admin-search-form' class="row justify-content-end" action="/admin/product" method='get'>
            <div class=" btn-group col-12 col-sm-6 col-md-4 col-lg-3 row">
                <input name="key" class=" col-9 text-truncate" type="text" placeholder="Nhập tên sản phẩm">
                <button class="btn col-3 fw-bolder">Tìm</button>
            </div>
        </form>
        <div class="text-end px-4">
            <a class="admin-create-product-btn" href="/admin/product/create"><i class="fa-solid fa-folder-plus fa-lg"></i> Thêm sản phẩm</a>
        </div>
    </div>
    <hr>
    <?php
   
    if (empty($products) || !isset($products)) {
     
        echo '<div class="py-3 col-12 text-secondary text-center"><h2>Không tìm thấy có sản phẩm nào</h2></div>';
    } else {
    
    ?>
        <table id="myTable" class="admin-table container-fluid text-center">
            <tr>
    
                <th>Hình ảnh</th>
                <th onclick="sortTable(2)">Tên <i style="cursor: pointer" class="btn-sort fa-solid fa-sort fa-lg"></i></th>
                <th>Mô tả </th>
                <th onclick="sortTable(4)">Loại <i style="cursor: pointer" class="btn-sort fa-solid fa-sort"></i></th>
                <th>Giá ($)</th>
                <th>Số lượng </th>
                <th>Thao tác</th>
            </tr>
            <?php
            
            foreach ($products as $sp) :
            ?>
                <tr class="info">
                    <td class="p-1"><img style="border-radius:3%" width="130px" class=" img-fluid" src="/uploads/<?= html_escape($sp->getProductAvatar()) ?>" alt="Ảnh chờ cập nhật"></td>
                    <td><?= html_escape($sp->getName());?></td>
                    <td><p><?= html_escape($sp->getDescription())?></p></td>
                    <td><?= html_escape($sp->getCategory()) ?? '' ?></td>
                    <td><?= html_escape($sp->getUnitPrice()) ?></td>
                    <td><?= html_escape($sp->getStockQuantity()) ?? '' ?></td>
                    <td><a class="p-1 mb-1 btn-edit btn" href="/admin/product/edit?id=<?= $sp->getId()??'' ?>"><i class="fa-solid fa-pen"></i></a>

                        <form class="d-inline" action="/admin/product/delete" method="get">
                            <input type="hidden" name="id" value="<?= $sp->getId()??''  ?>">
                            <button class="p-1 mb-1 btn btn-remove btn-admin-remove-product"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <!-- Pagination -->
 <nav class="d-flex justify-content-center">
        <ul class="pagination">

            <li class="page-item <?php echo $paginator->getPrevPage() ? '' : 'disabled'; ?>">
                <a role="button" href="<?php
                                            if (isset($_GET['key'])) {
                                                echo '/admin/product?key=' . html_escape($_GET['key']).'&';
                                            }else{
                                                 echo '/admin/product?';
                                            }
                                            ?>page=<?= $paginator->getPrevPage() ?>" class="page-link">
                    <span class="fw-bolder d-block">&laquo;</i></span>
                </a>
            </li>

            <?php foreach ($pages as $page) : ?>
                <li class="page-item <?php echo $paginator->currentPage === $page ? 'active' : ''; ?>">
                    <a role="button" href="<?php
                                            if (isset($_GET['key'])) {
                                                echo '/admin/product?key=' . html_escape($_GET['key']).'&';
                                            }else{
                                                 echo '/admin/product?';
                                            }
                                            ?>page=<?= $page ?>" class="page-link">
                        <?= $page ?>
                    </a>
                </li>
            <?php endforeach; ?>
            <li class="page-item <?php echo $paginator->getNextPage() ? '' : 'disabled'; ?>">
                <a role="button" href="<?php
                                            if (isset($_GET['key'])) {
                                                echo '/admin/product?key=' . html_escape($_GET['key']).'&';
                                            }else{
                                                 echo '/admin/product?';
                                            }
                                            ?>page=<?= $paginator->getNextPage() ?>" class="page-link">
                    <span class="fw-bolder">&raquo;</span>
                </a>
            </li>

        </ul>

    </nav>
    <!-- Pagination -->
    <?php } ?>
</div>

 