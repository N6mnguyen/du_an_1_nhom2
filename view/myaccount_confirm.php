<?php
if(isset($_SESSION['s_user'])&&($_SESSION['s_user']>0)){
 extract($_SESSION['s_user']);
 $userinfo = get_user($id);
 $_SESSION['s_user']=$userinfo;
 extract( $userinfo);


}
?>
<div class="containerfull">
    <div class="bgbanner">Thay đổi mật khẩu</div>
</div>

<section class="containerfull">
    <div class="container">
        <div class="boxleft mr2pt menutrai">
            <h2>DÀNH CHO BẠN</h2><br><br>
            <a href="index.php?pg=myaccount">Cập Nhật Thông Tin</a>
            <a href="index.php?pg=mybill">Lịch Sử Mua Hàng</a>
            <a href="index.php">Thoát</a>
        </div>
        <div class="boxright">
            <h1>Thông Tin Tài Khoản</h1><br>
            <div class="containerfull mr30">
                    <div class="row">
                        <div class="col-25">
                            <label  for="fname">TÊN ĐĂNG NHẬP</label>
                        </div>
                        <div class="col-75">
                          <?=$username?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="lname">Email </label>
                        </div>
                        <div class="col-75">
                        <?=$email?>
                        </div>
                    </div>
                 
                    <div class="row">
                        <div class="col-25">
                            <label for="lname">Địa Chỉ </label>
                        </div>
                        <div class="col-75">
                      <?=$diachi?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="lname">Số Điện thoại </label>
                        </div>
                        <div class="col-75">
                          <?=$dienthoai?>
                        </div>
                    </div>
                    </div>
         
            </div>
        </div>


    </div>
</section>
