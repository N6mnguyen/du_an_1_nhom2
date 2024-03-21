<?php

?>
<div class="containerfull">
    <div class="bgbanner">ĐĂNG NHẬP</div>
</div>

<section class="containerfull">
    <div class="container">
        <div class="boxleft mr2pt menutrai">
            <h2>DÀNH CHO BẠN</h2><br><br>
            <a href="index.php?pg=quenmk">Quên mật khẩu</a>
            <a href="#">Thoát</a>
        </div>
        <div class="boxright">
            <h1>Đăng Nhập</h1><br>
            <div class="containerfull mr30">
                <h2 style="color: red;" >
               <?php 
               if(isset($_SESSION['tb_dangnhap'])&&($_SESSION['tb_dangnhap']!="")){ 
                echo $_SESSION['tb_dangnhap'];
                unset($_SESSION['tb_dangnhap']);
               }
               ?>
                </h2>
                <form action="index.php?pg=dangnhap" onsubmit="return sendLogin()" method="post" >
                    <div class="row">
                        <div class="col-25">
                            <label  for="fname">TÊN ĐĂNG NHẬP</label>
                        </div>
                        <div class="col-75">
                            <input type="text" class="inputt" id="nameDN" name="username" placeholder="TÊN ĐĂNG NHẬP">
                            <h3 class="nameDN-error rr" style="color: red;" > </h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="lname">NHẬP MẬT KHẨU </label>
                            
                        </div>
                        <div class="col-75">
                            <input type="password" class="inputt" id="pass" name="password" placeholder="NHẬP MẬT KHẨU">
                            <h3 class="pass-error rr" style="color: red;" > </h3>
                        </div>
                    </div>
                    </div>
             
                    <br>
                    <div class="row">
                        <input type="submit" class="dksm" name="submit" value="Submit">
                    </div>
                </form>
            </div>
        </div>


    </div>
</section>
<style>
    .rr{
        font-size: small;
    }
</style>