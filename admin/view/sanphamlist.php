<?php
$html_sanphamlist = showsp_admin($sanphamlist);
?>
<div class="main-content">
    <h3 class="title-page">Sản phẩm</h3>
    <div class="d-flex justify-content-end">
        <a href="admin.php?pg=sanphamadd" class="btn btn-primary mb-2">Thêm sản phẩm</a>
    </div>
    <table id="example" class="table table-striped" style="width: 100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Hình</th>
                <th>Tên SP</th>
                <th>Giá</th>
                <th>Thao Tác</th>
            </tr>
        </thead>

        <tbody>
            <?= $html_sanphamlist ?>
        </tbody>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>Hình</th>
                <th>Tên SP</th>
                <th>Giá</th>
                <th>Thao Tác</th>
            </tr>
        </tfoot>
    </table>
    
    <?php
    for ($i = 1; $i <= $total_pages; $i++) {
        ?>
        <button class="phantrang"><a class="nutphantrang" href='admin.php?pg=sanphamlist&page=<?= $i ?>'>
            <?= $i ?>
        </a></button>
    <?php
    } ?>
    
</div>
</div>
</div>
<script src="assets/js/main.js"></script>
<script>
    new DataTable("#example");
</script>

