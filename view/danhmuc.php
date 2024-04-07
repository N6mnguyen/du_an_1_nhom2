<?php
// $html_dssp_caphe = showsp($dssp_caphe);
// $html_dssp_tra = showsp($dssp_tra);
?>

<div class="containerfull">
<!--     <div class="bgbanner">Danh Mục</div> -->
</div>

<section class="containerfull bg1 padd50">
    <div class="container">
        <h1>DANH MỤC SẢN PHẨM HOT</h1>
        <?php 
        foreach($dsdm as $value){
        ?>
        <div class="row">
            <h2><?=$value['name']?></h2>
        </div>
        <?= showsp(get_sp_hot($value['id'],4)) ?>
        <?php
        }
        // die();
        ?>
    </div>
</section>
