<?php
$html_dssp_new = showsp($dssp_new);
$html_dssp_best = showsp($dssp_best);
$html_dssp_caphe = showsp($dssp_caphe);
$html_dssp_tra = showsp($dssp_tra);
$html_dssp_banhmi=showsp($dssp_banhmi);


?>

<div class="containerfull">
<!--     <div class="bgbanner">TRANG CHỦ</div> -->
</div>
<section class="containerfull">
    <div class="container">
        <h1>SẢN PHẨM HOT</h1><br>
        <div class="containerfull">
            <div class="box50 mr15">
                <img src="layout/images/banner2.webp" alt="">
            </div>
            <?= $html_dssp_best ?>
        </div>

        <div class="containerfull mr30">
            <h1>SẢN PHẨM MỚI</h1><br>
            <?= $html_dssp_new; ?>
        </div>

    </div>
</section>


<section class="containerfull bg1 padd50">
    <div class="container">
        <h1>DANH MỤC SẢN PHẨM HOT</h1>
        <div class="row">
            <h2>Cà phê</h2>
        </div>
        <?= $html_dssp_caphe ?>
        <div class="row">
            <h2>Trà</h2>
        </div>
        <?= $html_dssp_tra ?>

        <div class="row">
        <h2>Bánh Mì</h2> 
        </div>
        <?= $html_dssp_banhmi ?>

    </div>
</section>
