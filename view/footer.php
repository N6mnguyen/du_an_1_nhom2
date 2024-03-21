<?php 


?>
<script src="./dao/account.js"></script>
<footer class="containerfull padd50">
    <div class="ww">
        <div id="footer">
            
            <div class="footer-left">
            <div class="footer-logo">
                    
                </div>
                <div class="card_1">
                    <div class="tt">
                        <h3>Công ty cổ phần thương mại dịch vụ Trà Cà Phê VN</h3>
                        <ul>
                            <li><i class="fa-sharp fa-solid fa-location-pin"></i> Tầng 2 tòa nhà T10, Times City Vĩnh
                                Tuy, Hai Bà Trưng, Hà Nội.</li>
                            <li><i class="fa-solid fa-phone-flip"></i> 1900.63.69.36</li>
                            <li> <i class="fa-solid fa-envelope"></i> info@tocotocotea.com</li>
                            <li>Số ĐKKD: 0106341306. Ngày cấp: 16/03/2017.</li>
                            <li>Nơi cấp: Sở kế hoạch và Đầu tư Thành phố Hà Nội.</li>
                        </ul>
                    </div>
                    <div class="icons">
                        <i class="fa-brands fa-facebook"></i>
                        <i class="fa-brands fa-square-instagram"></i>
                        <i class="fa-brands fa-youtube"></i>
                        <i class="fa-brands fa-square-twitter"></i>
                        <i class="fa-brands fa-google-plus"></i>
                    </div>
                    <div class="images">
                        <div class="image">
                            <img src="layout/images/anh1.jpg" alt="" />
                        </div>
                        <div class=" image">
                            <img src="layout/images/anh2.jpg" alt="" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-right">
                <div class="gt">
                    <div class="card_2">
                        <h3>Giới thiệu</h3>
                        <ul>
                            <li><a href="#">Về Chúng Tôi</a></li>
                            <li><a href="gioithieu.html">Sản phẩm</a></li>
                            <li><a href="#">Khuyến mãi</a></li>
                            <li><a href="#">Chuyện cà phê</a></li>
                            <li><a href="#">Cửa Hàng</a></li>
                            <li><a href="#">Tuyển dụng</a></li>
                        </ul>
                    </div>
                    <div class="card_3">
                        <h3>Điều khoản</h3>
                        <ul>
                            <li><a href="#">Điều khoản sử dụng</a></li>
                            <li><a href="#">Chính sách bảo mật thông tin</a></li>
                            <li><a href="#">Hướng dẫn xuất hóa đơn GTGT</a></li>
                            <li><a href="#">Đổi trả và hoàn tiền</a></li>
                            <li><a href="#">Bảo vệ thông tin cá nhân</a></li>
                        </ul>
                    </div>
                    <script async defer crossorigin="anonymous"
                src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v18.0" nonce="9m9LaG5o"></script>
            <div class="fb-page" data-href="https://www.facebook.com/profile.php?id=61552925616427"
                data-tabs="Coffe House" data-width="300px" data-height="500px" data-small-header="false"
                data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                <blockquote cite="https://www.facebook.com/profile.php?id=61552925616427" class="fb-xfbml-parse-ignore">
                    <a href="https://www.facebook.com/profile.php?id=61552925616427">Coffe House</a></blockquote>
            </div>
                </div>


            </div>

            <div id="fb-root"></div>

        </div>
    </div>
    <!-- footer section ends -->
</footer>

</body>


</html>

<style>
    footer {
        height: 300px;
    }

    .footer-left img {
        width: 300px;
        height: 130px;
    }

    #footer {
        width: 1440px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 60% 40%;
    }

    ul {
        list-style: none;
    }

    .card_2 ul,
    .card_3 ul {
        padding-left: 0;
    }

    .card_2 ul li,
    .card_3 ul li,
    .card_1 ul li  
    {
        margin: 5px 0;
    }

    .card_1 i p {
        font-family: tahoma;
    }

    
    .tt ul li {
        margin: 10px 0;
    }

    .tt ul {
        padding-left: 0;
    }

    .footer-left {
        display: grid;
        grid-template-columns: 30% 70%;
    }

    .footer-right {
        display: grid;
        grid-template-columns: 80% 20%;
    }



    .ww {
        height: 460px;
        background-color: #715445;
    }

    .images .image img {
        width: 170px;
        height: 65px;
        border-radius: 5px;
    }

    .images {
        display: grid;
        grid-template-columns: 1fr 1fr;
        width: 360px;
    }

    .icons {
        margin-bottom: 20px;
    }

    .fb-page {
        margin: auto;
    }

    .card_2 ul li a,
    .card_3 ul li a {
        color: #fff;
        font-weight: 400;
    }

    .card_2 {
        width: 120px;
    }

    .card_2 ul li a:hover,
    .card_3 ul li a:hover {
        color: #000;

    }

    .gt {
        display: grid;
        grid-template-columns: 30% 70%;
        gap: 20px;
        width: 380px;
    }
</style>