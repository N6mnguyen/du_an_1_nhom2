<?php 
$html_trangthailist = show_trangthai( $show_tt, $value['id_trangthai']);
?>
<div class="main-content">
    <h3 class="title-page">
        Sửa trạng thái:
    </h3>

    <form class="addPro" action="admin.php?pg=updatebill" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Trạng thái:</label>
            <select class="form-select" name="idtt" aria-label="Default select example">
                <?=$html_trangthailist?>
            </select>
            <input type="hidden" name='idbill' value="<?=$_GET['idbill']?>">
        </div>
        <div class="form-group">
            <button type="submit" name="addtt" class="btn btn-primary">Cập nhật trạng thái</button>
        </div>
    </form>
</div>