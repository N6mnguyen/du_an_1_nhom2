<?php 
$as= showsp_admin($tk_hhct);
?>
<div class="main-content">
    <h3 class="title-page">Sản phẩm</h3>
    <table id="example" class="table table-striped" style="width: 100%">
        <thead>
            <tr>
                <th>ID SAN PHAM</th>
                <th>Hình</th>
                <th>Tên SP</th>
                <th>Giá</th>
                <th>Thao Tác</th>
            </tr>
        </thead>
        
        <tbody>
            
            <?= $as ?>
        </tbody>
        <tfoot>
            <tr>
                <th>ID SAN PHAM</th>
                <th>Hình</th>
                <th>Tên SP</th>
                <th>Giá</th>
                <th>Thao Tác</th>
            </tr>
        </tfoot>
    </table>
</div>
</div>
</div>
<script src="assets/js/main.js"></script>
<script>
    new DataTable("#example");
</script>
