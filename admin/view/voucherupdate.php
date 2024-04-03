<?php 
foreach($voucher as $value){
extract($value);
}
?>
<div class="main-content">
    <h3 class="title-page">
        Cập Nhật Voucher
    </h3>
    <form action="admin.php?pg=voucherupdate&id=<?=$id_voucher?>" onsubmit="return send()" method="post">
        <div class="form-group">
            <label for="name">Mã voucher:</label>
            <input type="text" class="form-control" name="mavoucher" value="<?=$ma_voucher?>" id="name" placeholder="Nhập mã voucher!">
            <p style="margin-top: 5px; text-align: left; color:red;" class="err_ma"></p>
        </div>
        <div class="form-group">
            <label for="name">Giá voucher:</label>
            <input type="text" class="form-control" name="gia" value="<?=$giatri?>" id="gia" placeholder="Nhập giá voucher!">
            <p style="margin-top: 5px; text-align: left; color:red;" class="err_gia"></p>
        </div>
        <div class="form-group">
            <label for="name">Số lượng:</label>
            <input type="text" class="form-control" name="soluong" value="<?=$soluong?>" id="sl" placeholder="Nhập số lượng!">
            <p style="margin-top: 5px; text-align: left; color:red;" class="err_sl"></p>
        </div>
        <div class="form-group">
            <button type="submit" name="updatevoucher" class="btn btn-primary">Cập nhật</button>
        </div>
    </form>
</div>
<script>
    function send() {
        let count = 0
        if (document.getElementById('name').value == '') {
            document.querySelector("p.err_ma").textContent = "Vui lòng nhập trường này!";
            count++
        }
        if (document.getElementById('sl').value == '') {
            document.querySelector("p.err_sl").textContent = "Vui lòng nhập trường này!";
            count++
        }
        if (document.getElementById('gia').value == '') {
            document.querySelector("p.err_gia").textContent = "Vui lòng nhập trường này!";
            count++
        }
        
        if (count > 0) {
            return false;

        }
    }
</script>
