<?php
$erro = '';

if (isset($_SESSION['error_email']) && ($_SESSION['error_email'] != "")) {
    $erro =  $_SESSION['error_email'];
    unset($_SESSION['error_email']);
}
?>
<div class="containerfull">
    <div class="bgbanner">ĐĂNG KÝ TÀI KHOẢN</div>
</div>

<section class="containerfull">
    <div class="container">
        <div class="boxleft mr2pt menutrai">
            <h2>DÀNH CHO BẠN</h2><br><br>
            <a href="index.php">Thoát</a>
        </div>
        <div class="boxright">
            <h1>Đăng Kí</h1><br>
            <div class="containerfull mr30">
            <h2 style="color: red;" >
               <?php 
                echo $erro;
               ?>
                </h2>
                <form action="index.php?pg=adduser" onsubmit="return sendSignup()" method="post">
                    <div class="row">
                        <div class="col-25">
                            <label for="lname">Email </label>
                        </div>
                        <div class="col-75 ">
                            <input type="text" class="inputt" id="lname" name="email" placeholder="Email">
                            <h3 class="email-error rr" style="color: red;"> </h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="fname">TÊN ĐĂNG NHẬP</label>
                        </div>
                        <div class="col-75 ">
                            <input type="text" class="inputt" id="fname" name="username" placeholder="TÊN ĐĂNG NHẬP">
                            <h3 class="username-error rr" style="color: red;"> </h3>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-25">
                            <label for="lname">NHẬP MẬT KHẨU </label>
                        </div>
                        <div class="col-75 ">
                            <input type="password" class="inputt" id="lname" name="password" placeholder="NHẬP MẬT KHẨU">
                            <h3 class="password-error rr" style="color: red;"> </h3>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-25">
                            <label for="lname">NHẬP LẠI MẬT KHẨU </label>
                        </div>
                        <div class="col-75 ">
                            <input type="password" class="inputt" id="lname" name="repassword" placeholder="NHẬP LẠI MẬT KHẨU">
                            <h3 class="repassword-error rr" style="color: red;"> </h3>
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
    .rr {
        font-size: small;
    }
</style>