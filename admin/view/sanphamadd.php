<?php 
$html_danhmuclist = showdm_admin($danhmuclist);
?>
<div class="main-content">
    <h3 class="title-page">
        Thêm sản phẩm
    </h3>
    <form action="admin.php?pg=addproduct" onsubmit="return send()" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputFile">Ảnh sản phẩm</label>
            <div class="custom-file">
                <input type="file" name="image[]" class="custom-file-input" id="exampleInputFile" multiple>
                <p style="margin-top: 5px; text-align: left; color:red;" class="err_anh"></p>
            </div>
        </div>
        <div class="form-group">
            <label for="name">Tên sản phẩm:</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Nhập tên sản phẩm">
            <p style="margin-top: 5px; text-align: left; color:red;" class="err_name"></p>
        </div>
        <div class="form-group">
            <label for="categories">Danh mục:</label>
            <select class="form-select" id="iddm" name="iddm" aria-label="Default select example">
                <option hidden value="">Chọn danh mục</option>
                <?=$html_danhmuclist?>
            </select>
            <p style="margin-top: 5px; text-align: left; color:red;" class="err_dm"></p>

        </div>
        <div class="form-group">
            <label for="name">Mô tả:</label>
            <input type="text" class="form-control" name="mota" id="mota" placeholder="Nhập mô tả">
            <p style="margin-top: 5px; text-align: left; color:red;" class="err_mota"></p>
        </div>
        <div class="form-group">
            <label for="price">Giá gốc:</label>
            <div class="input-group mb-3">
                <div class="input-group-append">
                    <span class="input-group-text">đ</span>
                </div>
                <input type="text" name="price" id="price" class="form-control" placeholder="Nhập giá gốc">
            </div>
            <p style="margin-top: 5px; text-align: left; color:red;" class="err_price"></p>
        </div>
        <div class="form-group" >
            <label for="bestseller">Best seller:</label>
            <input type="checkbox" class="" name="bestseller"  value="1">
        </div>
        <div class="form-group">
            <div style="display:grid;grid-template-columns: 50% 50%;     align-items: center;">
                <div class="form-group col-md-10">
                    <div id="size-container">
                        <label for="price">Size:</label>
                        <input type="text" id="size" name="size[]" class="form-control" placeholder="Nhập size">
                    </div>
                </div>
                <div class="form-group col-md-10">
                    <div id="soluong-container">
                        <label for="price">Tiền:</label>
                        <input type="text" id="tien" name="tien[]" class="form-control" placeholder="Nhập tiền">
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-success" id="addSizeButton" style="margin-bottom:20px;">Thêm size</button>
        </div>
        <div class="form-group">
            <button type="submit" name="addproduct" class="btn btn-primary">Thêm sản phẩm</button>
        </div>

    </form>
</div>

<style>
    .rr{
        font-size: small;
    }
</style>
<script>
function send() {
    count =0;
    if (document.getElementById('exampleInputFile').value=='') {
        document.querySelector("p.err_anh").textContent = "Vui lòng nhập trường này!";
        count ++
    }
    if (document.getElementById('name').value=='') {
        document.querySelector("p.err_name").textContent = "Vui lòng nhập trường này!";
        count ++
    }
    if (document.getElementById('iddm').value=='') {
        document.querySelector("p.err_dm").textContent = "Vui lòng nhập trường này!";
        count ++
    }
    if (document.getElementById('mota').value=='') {
        document.querySelector("p.err_mota").textContent = "Vui lòng nhập trường này!";
        count ++
    }
    if (document.getElementById('price').value=='') {
        document.querySelector("p.err_price").textContent = "Vui lòng nhập trường này!";
        count ++
    }
    
    if (count>0) {
        return false;
    }
}
</script>
