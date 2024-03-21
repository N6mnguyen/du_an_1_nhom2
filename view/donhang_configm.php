
<div class="containerfull">
        <div class="bgbanner">ĐƠN HÀNG</div>
    </div>

    <section class="containerfull">
        <div class="container">
            <h2>Cảm ơn quý khách. Đơn hàng đã đặt thành công. <br>
            Quý khách có thể theo dõi đơn hàng <a href="index.php?pg=mybill">tại đây . <br>
             Mã đơn hàng : <?=(isset($_SESSION['madon']))?$_SESSION['madon']:"" ?></a>
            <?php unset($_SESSION['madon']);?>
            </h2>
        </div>
    </section>