<div class="containerfull">
    <div class="bgbanner">CHI TIẾT ĐƠN HÀNG</div>
</div>
<div class="containerfull">
    <div class="container">
        <div class="yy">
            <div class="title">
                <h1>Chi Tiết Đơn Hàng</h1>
            </div>
            <div class="status">
                <div class="address">
                    <h2>
                        <p><strong>Địa Chỉ Nhận Hàng</strong></p>
                    </h2>
                    <p><span style="font-size: 18px; margin-right: 5px;">👤</span>
                        <?= $ten ?>
                    </p>
                    <p><span style="font-size: 18px; margin-right: 5px;">🏠</span>
                        <?= $diachi ?>
                    </p>
                    <p><span style="font-size: 18px; margin-right: 5px;">☎️</span>
                        <?= $sdt ?>
                    </p>
                </div>

                <div class="delivery-status">
                    <h3>
                        <h2><p ><strong>Trạng Thái Vận Chuyển</strong></p></h2>
                    </h3>
                    <p class="end"><strong style="margin-right:5px;">Ngày Mua:</strong><time datetime="<?= $ngaymua ?>">
                            <?= $ngaymua ?>
                        </time></p>
                    <p class="end">
                        <?= $tentrangthai ?>
                    </p>
                </div>
            </div>
            <?= $sp ?>

            <div class="summary">
                <p><strong>Tổng Tiền Hàng:</strong><span>
                        <?= number_format($tong, 0, ',', '.') ?> đ
                    </span></p>
                <p><strong>Voucher từ Shop:</strong><span> -
                        <?= $voucher ?> đ
                    </span></p>
                <p><strong>Thành Tiền:</strong><span>
                        <?= number_format($tongthanhtoan, 0, ',', '.') ?> đ
                    </span></p>
            </div>
        </div>
    </div>
</div>
<style>
   .tien {
    width: 100px;
    margin-top: 80px;
}
    .container {
        width: 1045px;
        margin: 0 auto;
        font-family: Arial, Helvetica, sans-serif;
        box-shadow: 0 -5px 10px 0 rgba(185, 185, 185, 0.5), 0 15px 20px 0 rgba(185, 185, 185, 0.5);
        border-radius: 15px;
    }

    .yy {
        margin: 0 20px;
    }

    .title {
        display: flex;
        justify-content: center;
        padding-top: 20px;
    }

    .status {
        display: flex;
        justify-content: space-between;
        border-bottom: 0.5px #666666 solid;
    }

    .summary p {
        display: flex;
        justify-content: space-between;
    }

    .summary {
        padding-bottom: 1px;

    }

    .product {
        display: grid;
        grid-template-columns: 94% 6%;
        border-bottom: 0.5px #666666 solid;
        margin-top: 20px;
    }

    .product img {
        width: 100px;
        height: 100px;
        border-radius: 15px;

    }

    p {
        display: block;
    }

    .tien {
        width: 100px;
        margin-top: 80px;
    }

    /* Thêm style cho ngày mua */
    .delivery-status p.end {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        align-items: baseline
    }

    .delivery-status p.end::before {
        content: "\1F4C5";
        /* Unicode icon for calendar */
        font-size: 18px;
        margin-right: 5px;
    }

    /* Định dạng ngày mua và thêm icon */
    .delivery-status p.end strong::before {
        content: "\1F4C5";
        /* Unicode icon for calendar */
        font-size: 18px;
        margin-right: 5px;
    }

    .delivery-status p.end span {
        margin-left: 5px;
    }

    /* Định dạng thêm icon cho trạng thái vận chuyển */
    .delivery-status p.end::before {
        content: "\1F4E6";
        /* Unicode icon for package */
        font-size: 18px;
        margin-right: 5px;
    }
    p{
        display: block;
    }
</style>
