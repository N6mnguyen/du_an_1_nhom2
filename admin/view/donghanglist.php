<?php
$html_dh = show_donhang($show_dh);
?>
<div class="main-content">
    <h3 class="title-page">Đơn hàng</h3>

    <table id="example" class="table table-striped" style="width: 100%">
        <thead>
            <tr>
                <th>STT</th>
                <th>Mã đơn hàng</th>
                <th>Tên nhận hàng</th>
                <th>Điện thoại người nhận</th>
                <th>Địa chỉ người nhận</th>
                <th>Tổng thanh toán</th>
                <th>PTTT</th>
                <th>Trạng thái</th>
                <th>Thao Tác</th>
            </tr>
        </thead>
        <?=$html_dh?>
        <tbody>
            
        </tbody>
        <tfoot>
            <tr>
            <th>STT</th>
                <th>Mã đơn hàng</th>
                <th>Tên nhận hàng</th>
                <th>Điện thoại người nhận</th>
                <th>Địa chỉ người nhận</th>
                <th>Tổng thanh toán</th>
                <th>PTTT</th>
                <th>Trạng thái</th>
                <th>Thao Tác</th>
        </tfoot>
    </table>
    <?php 
        for ($i = 1; $i <= $sotrang; $i++) {
    ?>
        <button class="phantrang"><a class="nutphantrang" href='admin.php?pg=bills&page=<?=$i?>'><?=$i?></a></button>
    <?php 

    }
    ?>
</div>
</div>
</div>
<script src="assets/js/main.js"></script>
<script>
    new DataTable("#example");
</script>