
<div class="main-content">
    <h3 class="title-page">Voucher:</h3>
    <div class="d-flex justify-content-end">
        <a href="admin.php?pg=voucheradd" class="btn btn-primary mb-2">Thêm voucher</a>
    </div>
    <table id="example" class="table table-striped" style="width: 100%">
        <thead>
            <tr>
                <th>STT</th>
                <th>Mã voucher</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Trạng thái</th>
                <th>Thao Tác</th>
            </tr>
        </thead>
        
            <?php 
            foreach($voucherlist as $key=> $value){
            ?>
        <tbody>
                <th><?=$key+1?></th>
                <th><?=$value['ma_voucher']?></th>
                <th><?=number_format($value['giatri'],0,',','.')?> VNĐ</th>
                <th><?=$value['soluong']?></th>
                <th><?=$value['so_luong_chitiet']?>/<?=$value['soluong']?></th>
                <th>
                    <a href="admin.php?pg=voucherupdate&id=<?=$value['id_voucher']?>" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i> Sửa</a>
                    <a href="admin.php?pg=delvoucher&id=<?=$value['id_voucher']?>" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Xóa</a>
                </th>
        </tbody>
            <?php
            }
            ?>
        <tfoot>
            <tr>
            <th>STT</th>
                <th>Mã voucher</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Trạng thái</th>
                <th>Thao Tác</th>
        </tfoot>
    </table>
    <?php 
        for ($i = 1; $i <= $sotrang; $i++) {
    ?>
        <button class="phantrang"><a class="nutphantrang" href='admin.php?pg=voucherlist&page=<?=$i?>'><?=$i?></a></button>
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
