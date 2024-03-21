<?php 
$hh= show_thong_kebl($tk_bl);
?>
<div class="main-content">
    <h3 class="title-page">Quản lí bình luận:</h3>

    <table id="example" class="table table-striped" style="width: 100%">
        <thead>
            <tr>
                <th>MÃ SẢN PHẨM</th>
                <th>HÌNH ẢNH</th>
                <th>TÊN SẢN PHẨM</th>
                <th>SỐ LƯỢNG BÌNH LUẬN</th>
                <th>Thao TÁC</th>

            </tr>
        </thead>
        <tbody>
            <?php
            echo $hh;
            ?>
        </tbody>
    </table>
   
    <?php
    for ($i = 1; $i <= $total_pages; $i++) {
        ?>
        <button class="phantrang"><a class="nutphantrang" href='admin.php?pg=binhluanlist&page=<?= $i ?>'>
            <?= $i ?>
        </a> </button>
    <?php
    } ?>
   
</div>
</div>
</div>
