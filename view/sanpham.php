<?php
    $html_dm=showdm($dsdm);
    $html_dssp=showsp($dssp);
    if($titlepage!="") $title =$titlepage;
    else  $title ="Sản Phẩm";
?>
<div class="containerfull">
<!--     <div class="bgbanner"><?=$title?></div> -->
</div>

<section class="containerfull">
    <div class="container">
        <div class="boxleft mr2pt menutrai">
            <h1>DANH MỤC</h1><br><br>
            <?=$html_dm;?>
            <form action="index.php?pg=sanpham" method="get">
            <input type="hidden" name="pg" value="sanpham">
            <div class="he">
                <div class="">
                    <div class="ko">Khoảng Giá</div>
                    <div class="hi">
                        <input type="text" maxlength="13" class="" name="min" placeholder="₫ TỪ" value="">
                        <div></div>
                        <input type="text" maxlength="13" class="" name="max"  placeholder="₫ ĐẾN" value="">
                    </div>
                </div>
                <div class='ok'>
                    <button class="nut button">Áp dụng</button>
                </div>
            </div>
        </form>
        </div>
        <div class="boxright">
            <h1><?=$title?></h1><br>
            <div class="containerfull mr30">
                <?=$html_dssp;?>
                
            </div>
            <div>
            <?php
            if ($iddm!='') {
                for ($i = 1; $i <= $total_pages; $i++) {
            ?>
                <button class="phantrang"><a class="nutphantrang" href='index.php?pg=sanpham&iddm=<?=$iddm?>&page=<?=$i?>'><?=$i?></a></button>
            <?php
            }
            }else if ($min!=''||$max!='') {
                for ($i = 1; $i <= $total_pages; $i++) {
            ?>
                  <button class="phantrang"><a class="nutphantrang" href='index.php?pg=sanpham&min=<?=$min?>&max=<?=$max?>&page=<?=$i?>'><?=$i?></a></button>
            <?php
                }
            }
            else if ($kyw!="") {
                for ($i = 1; $i <= $total_pages; $i++) {
            ?>
                  <button class="phantrang"><a class="nutphantrang" href='index.php?pg=sanpham&kyw=<?=$kyw?>&timkiem=Go&page=<?=$i?>'><?=$i?></a></button>
            <?php
                }
            }
            
            else{
                for ($i = 1; $i <= $total_pages; $i++) {
            ?>
                <button class="phantrang"> <a class="nutphantrang" href='index.php?pg=sanpham&page=<?=$i?>'><?=$i?></a></button>
            <?php 
                }
            }?>
        </div>
        </div>

       
    </div>
</section>
<style>
    .phantrang {
        display: inline-block;
        padding: 3px 10px;
        text-decoration: none;
        background-color: #ffedcc;
        color: #fff;
        border: 1px solid #ffedcc;
        border-radius: 5px;
        cursor: pointer;
    }

    .phantrang a {
        color: black;
    }

    .phantrang a:hover {
        color: blue;
        text-decoration: underline;
    }
    .hi{
        display: grid;
        grid-template-columns: 45% 10% 45%;
    }
    .ok{
        margin-left: 5px;
    }
    .ko{
        margin-bottom: 10px;
    }
    .ok .nut{
        margin-top: 20px;
        padding: 5px 10px !important;
        max-width: 100px;
        font-size: small;
    }
</style>
