<div class="main-content">
<div class="containerfull">
    <div style="display: flex; justify-content: space-between;">
        <h3 class="title-page">Đơn hàng</h3>
        <?php 
            if ($id_trangthai!=5 && $id_trangthai!=6) {
                echo '<a style="height: 40px; margin-top: 15px;" href="admin.php?pg=updatebill&idbill='.$_GET['idbill'].'" class="btn btn-success"><i class="fa-regular fa-eye" aria-hidden="true"></i> Sửa</a>';
            }
        ?>
       
    </div>
<div class="container">
    <div class="yy">
        <div class="status">
            <div class="address">
                <p><strong>Địa Chỉ Nhận Hàng:</strong></p>
                <p>Địa chỉ: <?=$diachi?></p>
                <p>Sđt: <?=$sdt?></p>
            </div>
            
            <div class="delivery-status">
                <p class="end"><strong>Trạng Thái Vận Chuyển:</strong></p>
                <p class="end"><?=$tentrangthai?></p>
                <p class="end"><?=$ngaymua?></p>
            </div>
        </div>
       <?=$sp?>

        <div class="summary" >
            <p><strong>Tổng Tiền Hàng:</strong><span > <?=number_format($tong,0,',','.')?> đ</span></p>   
            <p><strong>Voucher từ Shop:</strong><span > - <?=number_format($voucher,0,',','.')?> đ</span></p>
            <p ><strong>Thành Tiền:</strong><span > <?=number_format($tongthanhtoan,0,',','.')?> đ</span></p>
        </div>
    </div>
</div>
</div>
</div>
<style>
    .container {
        width: 1200px;
        margin: 0 auto;
        font-family: Arial, Helvetica, sans-serif;
        box-shadow: 0 -5px 10px 0 rgba(185, 185, 185, 0.5), 0 15px 20px 0 rgba(185, 185, 185, 0.5);
        border-radius: 15px;
    }
    .yy{
        margin: 0 20px;
    }
    .title{
        display: flex;
    justify-content: center;
    padding-top: 20px;
    }
    .status{
        display: flex;
        padding-top: 15px;
        justify-content: space-between;
        border-bottom: 0.5px #666666 solid;
    }
    .summary p{
        display: flex;
        justify-content: space-between;
    }
    .summary{
        padding-top: 10px;
        padding-bottom: 1px;

    }
    .product{
        display: grid;
        grid-template-columns: 93% 7% ;
        border-bottom: 0.5px #666666 solid;
        margin-top: 20px;
    }
    .product img{
        width: 100px;
        height: 100px;
        border-radius: 15px;

    }
    p{
        display: block;
    }
</style>