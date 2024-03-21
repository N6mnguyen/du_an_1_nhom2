<?php

?>
<div class="main-content">
    <h3 class="title-page">
        Thêm Danh Mục
    </h3>

    <form class="addPro" action="admin.php?pg=adddanhmuc" onsubmit="return send()" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Tên Danh Mục:</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Nhập tên Danh Mục">
            <p style="margin-top: 5px; text-align: left; color:red;" class="err_danhmuc"></p>
        </div>
        <div class="form-group">
            <label for="name">Ẩn hiện:</label>
            <input type="checkbox" value="1" name="trangthai">
            <label for="name">Hot:</label>
            <input type="checkbox" value="1" name="trangthai1">
        </div>
        <div class="form-group">
            <button type="submit" name="adddm" class="btn btn-primary">Thêm Danh Mục</button>
        </div>
    </form>
</div>

<script>
    new DataTable('#example');

    function send() {
        var count = 0;
        if (document.getElementById('name').value == '') {
            document.querySelector('.err_danhmuc').innerHTML = 'Không được để trống!';
            count++;
        }
        if (count > 0) {
            return false;
        }
    }
</script>