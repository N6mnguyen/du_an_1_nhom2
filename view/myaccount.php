<?php
if (isset($_SESSION['s_user']) && ($_SESSION['s_user'] > 0)) {
    extract($_SESSION['s_user']);
}

$erro = '';

if (isset($_SESSION['error_email']) && ($_SESSION['error_email'] != "")) {
    $erro =  $_SESSION['error_email'];
    unset($_SESSION['error_email']);
}
?>

<div class="containerfull">
    <div class="bgbanner">Cập Nhật Tài Khoản</div>
</div>

<section class="containerfull">
    <div class="container">
        <div class="boxleft mr2pt menutrai">
            <h2>DÀNH CHO BẠN</h2><br><br>
            <a href="index.php?pg=thaydoimatkhau">Thay đổi mật khẩu</a>
            <a href="index.php">Thoát</a>
        </div>
        <div class="boxright">
            <h1>Cập Nhật Tài Khoản</h1><br>
            <div class="containerfull mr30">
                <h2 style="color: red;">
                    <?php
                    echo $erro;
                    ?>
                </h2>
                <form action="index.php?pg=updatauser" onsubmit="return send()" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-25">
                            <label for="fname">TÊN ĐĂNG NHẬP</label>
                        </div>
                        <div class="col-75">
                            <input type="text" class="inputt names" value="<?= $username ?>" id="fname" name="username">

                            <h3 class="name-error rr" style="color: red;"> </h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="anh">ẢNH ĐẠI DIỆN </label>
                        </div>
                        <div class="col-75">
                            <div style="display: grid; grid-template-columns: 70% 30%; gap: 134px;">
                                <input st type="file" class="inputt" id="image" value="" name="image">
                                <img style="width: 100px;height: 100px;" src="./uploads/<?=$anh?>" alt="">
                            </div>
                            <h3 class="image-error rr" style="color: red;"> </h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="lname">Email </label>
                        </div>
                        <div class="col-75">
                            <input type="text" class="inputt email" value="<?= $email ?>" id="lname" name="email">
                            <h3 class="email-error rr" style="color: red;"> </h3>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-25">
                            <label for="lname">Địa Chỉ </label>
                        </div>
                        <div class="col-75">
                            <input type="text" class="inputt" value="<?= $diachi ?>" id="lname" name="diachi">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="lname">Số Điện thoại </label>
                        </div>
                        <div class="col-75">
                            <input type="text" class="inputt sdt" value="<?= $dienthoai ?>" id="lname" name="dienthoai">
                            <h3 class="sdt-error rr" style="color: red;"> </h3>

                        </div>
                    </div>
            </div>

            <br>
            <div class="row">
                <input type="hidden" name="id" value="<?= $id ?>">
                <input type="submit" class="dksm" name="capnhat" value="Cập nhật tài khoản">
            </div>
            </form>
        </div>
    </div>


    </div>
    <style>
        .rr {
            font-size: small;
        }
    </style>
</section>

<script>
    function checkImageFormat(fileInput) {
        alert(fileInput)
        if (fileInput.files && fileInput.files[0]) {
            var fileName = fileInput.files[0].name;
            var fileExtension = fileName.split('.').pop().toLowerCase();
            alert(fileExtension)

            if (fileExtension === 'jpg' || fileExtension === 'jpeg' || fileExtension === 'png' || fileExtension === 'webp') {
                return true;
            } else {
                return false;
            }
        }
    }

    function send() {

        var count = 0
        if (checkImageFormat(document.getElementById('image')) == false) {
            document.querySelector('h3.image-error').innerText = 'Định dạng hình ảnh không hợp lệ. Vui lòng chọn hình ảnh có định dạng .jpg, .png, .webp hoặc .jpeg!';
            count++
        } else {
            document.querySelector('h3.image-error').innerText = ''
        }
        if (isValidPhoneNumber(document.querySelector('.sdt').value) == false) {
            document.querySelector("h3.sdt-error").textContent = "Số điện thoại từ 9 đến 10 số bắt đầu từ 0!";
            count++
        }
        if (document.querySelector('.sdt').value == '') {
            count++
        }
        if (document.querySelector('.names').value == '') {
            count++
        }
        if (document.querySelector('.email').value == '') {
            count++
        } else if (!isValidEmail(document.querySelector('.email').value)) {
            document.querySelector("h3.email-error").textContent = "Email không đúng định dạng!";
            count++;
        }
        if (count > 0) {

            return false;
        }
    }

    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    function isValidPhoneNumber(phoneNumber) {
        phoneNumber = phoneNumber.trim();
        if (phoneNumber.startsWith('+84') || phoneNumber.startsWith('0')) {
            const numericPart = phoneNumber.replace(/\D/g, '');
            if (numericPart.length === 9 || numericPart.length === 10) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }
</script>
