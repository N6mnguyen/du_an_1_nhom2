<div class="containerfull">
    <div class="bgbanner">Thay đổi mật khẩu</div>
</div>

<section class="containerfull">
    <div class="container">
        <div class="boxleft mr2pt menutrai">
            <h2>DÀNH CHO BẠN</h2><br><br>
            <a href="index.php?pg=myaccount">Cập nhật tài khoản</a>
            <a href="index.php">Thoát</a>
        </div>
        <div class="boxright">
            <h1>Thay đổi mật khẩu</h1><br>
            <h3 class="thongbao" style="color: red;">
                <?php
                if (isset($thongbao1) && $thongbao1 != "") {
                    echo $thongbao1;
                }
                ?>
            </h3>
            <div class="containerfull mr30">
                <form action="index.php?pg=thaydoimatkhau" onsubmit="return send()" method="post">
                    <div class="row">
                        <div class="col-25">
                            <label for="oldPassword">Mật khẩu cũ:</label>
                        </div>
                        <div class="col-75">
                            <input type="password" class="inputt matkhau" name="oldPassword">
                            <h3 class="matkhau-error rr" style="color: red;"> </h3>
                            <input type="hidden" class="inputt oldmk" name="" value="<?=$kiempass['password']?>">
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="newPassword">Mật khẩu mới:</label>
                        </div>
                        <div class="col-75">
                            <input type="password" class="inputt matkhaumoi" name="newPassword">
                            <h3 class="mkmoi-error rr" style="color: red;"> </h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="confirmPassword">Xác nhận mật khẩu mới:</label>
                        </div>
                        <div class="col-75">
                            <input type="password" class="inputt xnmatkhau" name="confirmPassword">
                            <h3 class="xnmk-error rr" style="color: red;"> </h3>
                        </div>
                    </div>

            </div>

            <br>
            <div class="row">
                <input type="hidden" name="id" value="<?= $id ?>">
                <input type="submit" class="dksm" name="submit" value="Đổi mật khẩu">
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
