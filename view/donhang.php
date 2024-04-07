<?php

$thongbao = '';
$diachi = '';
$dienthoai = '';
$username = '';
if (isset($_SESSION['s_user']) && ($_SESSION['s_user'] > 0)) {
    // print_r($_SESSION['s_user']);
    // die();
    extract($_SESSION['s_user']);
    $thongbao1 = '';
    $diachinhanhang = noinhanhang($id);
    foreach ($diachinhanhang as $value) {
        if ($value['noinhan'] != '') {
            $diachi = $value['noinhan'];
        }
        if ($value['sdt'] != '') {
            $dienthoai = $value['sdt'];
        }
    }
} else {
    $thongbao1 = 'Vui lòng đăng nhập để thanh toán!';
}
if ($_SESSION['giohang'] == []) {
    $thongbao2 = 'Giỏ hàng chưa có sản phẩm!';
} else {
    $thongbao2 = '';
}
$tongtien = 0;
if (isset($_SESSION['giohang'])) {
    $tongtien = get_tongdonhang();
    // print_r($_SESSION['giohang']);
    // die();
    if (isset($_SESSION['giatrivoucher'])) {
        $voucher = $_SESSION['giatrivoucher'];
    } else {
        $voucher = 0;
    }
    $tongtienvch = $tongtien - $voucher;
}

?>
<div class="container">
    <div class="uu">
        <div class="xndh">
            <h1>Xác nhận đơn hàng</h1>
        </div>
        <div class="rr">
            <div class="content1">
                <form action="index.php?pg=updatedcnhan" onsubmit="return send()" method="post">
                    <div>
                        <div class="">
                            <h4>Giao hàng</h4>
                        </div>
                        <div class="form">
                            <div>
                                <p>Họ tên:</p>
                                <input type="text" name="hoten_nguoinhan" placeholder="Nhập họ tên" id="hoten" class="inputt" value="<?= $username ?>" />
                                <p style="margin-top: 5px; text-align: left; color:red;" class="err_hoten ll"></p>
                            </div>
                            <div>
                                <p>Địa chỉ:</p>
                                <input type="text" placeholder="Nhập địa chỉ" name="diachi_nguoinhan" id="diachi" class="inputt" value="<?= $diachi ?>" />
                                <p style="margin-top: 5px; text-align: left; color:red;" class="err_diachi ll"></p>
                            </div>
                            <div>
                                <p>Số điện thoại:</p>
                                <input type="text" placeholder="Nhập điện thoại" name="dienthoai_nguoinhan" id="dienthoai" class="inputt" value="<?= $dienthoai ?>" />
                                <p style="margin-top: 5px; text-align: left; color:red;" class="err_dienthoai ll"></p>
                            </div>
                            <div>
                                <p>Ghi chú:</p>
                                <input type="text" placeholder="Nhập ghi chú" name="ghichu" id="ghichu" value="<?= isset($_SESSION['ghichu']) ? $_SESSION['ghichu'] : '' ?>" />
                            </div>
                            <button style="width: 80px; margin-top: 20px;" name="capnhat" value="Cập nhật">Cập nhật</button>
                        </div>
                    </div>
                </form>
                <form action="index.php?pg=donhang" onsubmit="return send()" method="post">
                    <div class="bank">
                        <h4 style="margin-bottom: 0">Phương thức thanh toán:</h4>
                        <ul class="">
                            <li class="">
                                <div class="pay">
                                    <input type="radio" name="pttt" id="1" class="" value="1" checked />

                                    <span>
                                        <img width="40px" src="https://minio.thecoffeehouse.com/image/tchmobileapp/1000_photo_2021-04-06_11-17-08.jpg" alt="" />
                                    </span>
                                    <span class="text">Tiền mặt</span>

                                </div>
                            </li>

                        </ul>
                    </div>
            </div>
            <div></div>
            <div>
                <div class="content2">
                    <div style="margin: 20px 20px;">
                        <div class="title">
                            <h4 style="">Các món đã chọn</h4>
                            <a href="index.php?pg=sanpham">
                                <p>Thêm món</p>
                            </a>
                        </div>
                        <div class="product">
                            <?php
                            foreach ($_SESSION['giohang'] as $key => $sp) {
                                extract($sp);
                                if ($tien == 0) {
                                    $size = 'S';
                                } else if ($tien == 4000) {
                                    $size = 'M';
                                } else {
                                    $size = 'L';
                                }
                                echo '<div class="cart-item" style="margin-top:10px; border-bottom: 0.5px gray solid;">
                                            <div style="display: flex; justify-content: space-between;">
                                                <div class="amount-click-box">
                                                    <h5 style="margin-bottom: 10px;" class="cart__name">Sản phẩm: ' . $soluong . "x" . $name . '</h5>
                                                    <div >
                                                        <input type="hidden" name="" class="id__cart" value="' . $id . '">
                                                        <input type="hidden" name="" class="name__cart" value="' . $name . '">
                                                        <input type="hidden" name="" class="tien__cart" value="' . $tien . '">
                                                        <button type="button" class="click_left">-</button>
                                                        <input type="text" class="amount__cartItem  quantity-input" value="' . $soluong . '" id="" readonly>
                                                        <button type="button" class="click_right">+</button>
                                                        <input type="hidden" name="" class="price__cart" value="' . $thanhtien . '">
                                                        </div>
                                                </div>    
                                                <img class="img" src="uploads/' . $img . '" width="80px" height="80px" style="border-radius: 15px; "/>
                                            </div>
                                            <div style="display: flex; justify-content: space-between;">
                                                <p>Size: ' . $size . '</p>
                                                <p class="moneysend">' . number_format(($soluong * $thanhtien), 0, ',', '.') . 'đ</p>
                                            </div>
                                            <a href="index.php?pg=delgh&idsp=' . $idpro . '&tien=' . $tien . '"><p style="margin-top: 0;">Xóa</p></a>
                                        </div>';
                            }
                            ?>
                        </div>
                        <div class="total">
                            <h4>Tổng cộng</h4>
                            <div class="prd">
                                <p>Tổng</p>
                                <p class="price_full"><?= number_format($tongtien, 0, ',', '.'); ?>đ</p>
                            </div>
                            <div class="prd">
                                <p>Vocher</p>
                                <div>
                                    <div style="text-align: right;">
                                        <input style="margin-top: 15px;" type="text" name="ma_voucher" placeholder="Nhập vocher" id="noidung" />
                                        <button style="margin-top: 15px;" type="button" class="btvocher" name="btvocher">Nhập</button>
                                    </div>
                                    <p style="margin-top: 5px; text-align: right;" class="err_vou"></p>
                                    <p style="margin-top: 5px; text-align: right;" id="voucher"></p>
                                    <input type="hidden" class="price_hi" value="<?= $tongtienvch ?>">
                                    <input type="hidden" name="tienvouch" class="tienvou" value="0">
                                    <input type="hidden" name="idvouch" id="vouchid" value="">
                                    <input type="hidden" name="tongtien" class="tientong" value="<?= $tongtienvch ?>">

                                </div>
                            </div>
                            <div class="prd">
                                <p>Thành tiền</p>
                                <p class="price_full1"><?= number_format($tongtienvch, 0, ',', '.'); ?>đ</p>
                            </div>
                        </div>
                    </div>
                    <div class="prd mua">
                        <div style="margin-left: 20px;">
                            <p style="color:#e6e6e6; font-size:18px;">Thành tiền</p>
                            <p style="color:#e6e6e6; font-size:18px;" class="price_full2"><?= number_format($tongtienvch, 0, ',', '.'); ?>đ</p>
                        </div>
                        <button type="submit" name="submit" style="margin-right: 20px;">Đặt hàng</button>
                    </div>
                    </form>
                </div>
                <div style="margin-top: 20px;">
                    <a href="index.php?pg=viewcart&del=1">
                        <i class="fa fa-trash-o"></i> Xóa đơn hàng
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div style="display: grid; grid-template-columns:1fr;">
        <a style="margin-top: 20px;" href='./index.php?pg=dangnhap' target='_parent'><?= $thongbao1 ?></a>
        <a style="margin-top: 20px;" href='./index.php?pg=sanpham' target='_parent'><?= $thongbao2 ?></a>
    </div>
</div>


<script>
    function send() {
        let count = 0
        if (document.getElementById('hoten').value == '') {
            document.querySelector("p.err_hoten").textContent = "Vui lòng nhập trường này!";
            count++
        }
        if (document.getElementById('diachi').value == '') {
            document.querySelector("p.err_diachi").textContent = "Vui lòng nhập trường này!";
            count++
        }
        if (document.getElementById('dienthoai').value == '') {
            document.querySelector("p.err_dienthoai").textContent = "Vui lòng nhập trường này!";
            count++
        } else if (isValidPhoneNumber(document.getElementById('dienthoai').value) == false) {
            document.querySelector("p.err_dienthoai").textContent = "Số điện thoại từ 9 đến 10 số bắt đầu từ 0!";
            count++
        }
        if (count > 0) {
            return false;

        }
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
    var amountClickBoxS = document.querySelectorAll(".amount-click-box");
    var httpRequest = new XMLHttpRequest();
    var voucherclick = document.querySelector(".btvocher");
    $(document).ready(function() {

        voucherclick.addEventListener('click', function() {
            event.preventDefault();
            var noidung = $("#noidung").val();
            var tien = $(".price_hi").val();
            if (noidung == "") {
                $(".err_vou").text('Không được để trống!');
                $("#voucher").text("");

            } else {
                console.log(noidung)
                console.log(tien)
                $(".err_vou").text('');

                $.ajax({
                    url: "./view/ajaxVoucher.php",
                    method: "POST",
                    data: {
                        noidung: noidung,
                        tien: tien
                    },
                    success: function(data) {
                        if (data !== '') {
                            var dataj = data.split(',');
                            if (dataj[1]) {
                                // var dataj = data.split(',');
                                // alert(data)
                                $("#voucher").text("-" + Intl.NumberFormat('vi-VN').format(dataj[0]) + "đ");
                                $(".tienvou").val(dataj[0]);
                                $("#vouchid").val(dataj[2]);
                                $(".price_full1").text(Intl.NumberFormat('vi-VN').format(dataj[1]) + "đ");
                                $(".price_full2").text(Intl.NumberFormat('vi-VN').format(dataj[1]) + "đ");
                                $(".tientong").val(dataj[1]);
                            } else {
                                $("#voucher").text(data);
                            }
                            // if (data == 'Voucher đã sử dụng hoặc không tồn tại!') {
                            //     $("#voucher").text(data);
                            // } else {
                            //     var dataj = data.split(',');
                            //     // alert(data)
                            //     $("#voucher").text("-" + Intl.NumberFormat('vi-VN').format(dataj[0]) + "đ");
                            //     $(".tienvou").val(dataj[0]);
                            //     $("#vouchid").val(dataj[2]);
                            //     $(".price_full1").text(Intl.NumberFormat('vi-VN').format(dataj[1]) + "đ");
                            //     $(".price_full2").text(Intl.NumberFormat('vi-VN').format(dataj[1]) + "đ");
                            //     $(".tientong").val(dataj[1]);
                            // }
                        } else {
                            $("#voucher").text("Vui lòng thêm sản phẩm và đăng nhập!");
                        }

                    },

                });
            }
        });
    });




    amountClickBoxS.forEach(function(amountClickBox) {
        let id__cart = amountClickBox.querySelector('.id__cart');
        let cart__name = amountClickBox.querySelector('.cart__name');
        let tien__cart = amountClickBox.querySelector('.tien__cart').value;
        let name__cart = amountClickBox.querySelector('.name__cart').value;
        let amount__cartItem = amountClickBox.querySelector('.amount__cartItem');
        let click_left = amountClickBox.querySelector('.click_left');
        let click_right = amountClickBox.querySelector('.click_right');

        var tongtien = amountClickBox.parentElement.nextElementSibling.querySelector('.moneysend');
        var price__cart = amountClickBox.querySelector('.price__cart');


        // var checkBoxProductCart = document.querySelectorAll('.checkBox__productCart');
        var total_pricefull = document.querySelector('.price_full');
        var total_hi = document.querySelector('.price_hi');
        var total_pricefull1 = document.querySelector('.price_full1');
        var total_pricefull2 = document.querySelector('.price_full2');
        var amountCart = document.querySelectorAll('.amount__cartItem');
        var priceCartAll = document.querySelectorAll('.price__cart');


        click_left.addEventListener('click', function() {
            if (amount__cartItem.value > 1) {
                amount__cartItem.value--;
                updateProductTotal();
            }
        });

        click_right.addEventListener('click', function() {
            if (amount__cartItem.value < 10) {
                amount__cartItem.value++;
                updateProductTotal();
            }
        });

        function updateProductTotal() {
            let result = price__cart.value * amount__cartItem.value;
            let formattedTotal = result.toLocaleString('vi-VN').replace(/,/g, '.');
            tongtien.innerHTML = formattedTotal + 'đ';
            cart__name.innerHTML = 'Sản phẩm: ' + amount__cartItem.value + 'x' + name__cart;

            updateTotalPayment(); // Cập nhật tổng thanh toán
            updateCart(id__cart.value, amount__cartItem.value, tien__cart); // Gửi yêu cầu AJAX để cập nhật số lượng
        }

        // checkBoxProductCart.forEach(function (checkBoxProductCart) {
        //     if (checkBoxProductCart.checked == true) {
        //         updateTotalPayment();
        //     }
        // })

        function updateTotalPayment() {

            var totalPrice = 0;
            amountCart.forEach(function(amount, index) {
                totalPrice += amount.value * priceCartAll[index].value;
            });
            // alert($(".tienvou").val())

            if ($(".tienvou").val() != '') {
                totalPrices = totalPrice - $(".tienvou").val();
                total_hi.value = totalPrices;
                $(".tientong").val(totalPrices);
                total_pricefull.innerHTML = totalPrice.toLocaleString('vi-VN') + '₫';
                total_pricefull1.innerHTML = totalPrices.toLocaleString('vi-VN') + '₫';
                total_pricefull2.innerHTML = totalPrices.toLocaleString('vi-VN') + '₫';
            } else {
                total_hi.value = totalPrice;
                total_pricefull.innerHTML = totalPrice.toLocaleString('vi-VN') + '₫';
                total_pricefull1.innerHTML = totalPrice.toLocaleString('vi-VN') + '₫';
                total_pricefull2.innerHTML = totalPrice.toLocaleString('vi-VN') + '₫';
                $(".tientong").val(totalPrice);


            }

        }

        function updateCart(cartId, newAmount, tiencart) {
            httpRequest.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Xử lý kết quả nếu cần
                }
            }

            httpRequest.open("GET", "./view/ajaxCart.php?cart_id=" + cartId + "&soluong=" + newAmount + "&tien=" + tiencart, true);
            httpRequest.send();
        }
    });
</script>




<style>
     .container {
        width: 1045px;
        margin: 0 auto;
        font-family: Arial, Helvetica, sans-serif;

    }

    .xndh {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .rr {
        display: grid;
        grid-template-columns: 47% 6% 47%;
    }

    .content2 {
        border-radius: 7px;
        box-shadow: 0 -5px 10px 0 rgba(185, 185, 185, 0.5), 0 15px 20px 0 rgba(185, 185, 185, 0.5);
    }
    .img{
        box-shadow: 0 -3px 10px 0 rgba(185, 185, 185, 0.5), 0 5px 5px 0 rgba(185, 185, 185, 0.5);

    }
    .form p {
        margin-bottom: 0;
    }

    .form input {
        padding: 15px 23px;
        width: 90%;
        box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 5px;
    }

    ul li {
        list-style: none;
    }

    .pay {
        padding: 15px 0;
        border-bottom: 0.5px rgb(201, 201, 201) solid;
    }

    .title {
        display: flex;
        justify-content: space-between;
    }

    .title a {
        text-decoration: none;
        color: black;
    }

    .title p {
        border: 2px #8c8c8c solid;
        padding: 10px;
        border-radius: 30px;
        box-shadow: 0 -3px 10px 0 rgba(185, 185, 185, 0.5), 0 5px 5px 0 rgba(185, 185, 185, 0.5);


    }

    h4 {
        font-size: larger;
    }
    .click_right,
    .click_left {
        box-shadow: 0 -3px 10px 0 rgba(185, 185, 185, 0.5), 0 5px 5px 0 rgba(185, 185, 185, 0.5);
    }
    .prd {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 0.5px gray solid;
    }

    .mua {
        background-color: #9f897e;
        border-bottom: none;
        border-radius: 0 0 7px 7px;
        
    }

    .mua button {
        padding: 20px 25px;
        border: 1px rgb(255, 255, 255) solid;
        background-color: rgb(255, 255, 255);
        border-radius: 30px;
        box-shadow: 0 -3px 10px 0 rgba(185, 185, 185, 0.5), 0 5px 5px 0 rgba(185, 185, 185, 0.5);

    }

    .quantity-container {
        display: flex;
        align-items: center;
    }

    .quantity-input {
        width: 20px;
        text-align: center;
        font-size: 16px;
        margin: 0 8px;
        border: none;
    }
    .click_left,
    .click_right{
        width: 25px;
        height: 25px;
        border-radius: 26px;
        border: none;
        color: #fff;
        font-size: 20px;
        background-color: #cbb2a5;
    }
    .bank {
    width: 100%;
    max-width: 400px; /* Adjust the maximum width as needed */
    margin-top: 20px;
}

.bank h4 {
    margin-bottom: 0;
}

ul {
    list-style: none;
    padding: 0;
    
}

.pay {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

.pay img {
    width: 40px;
    height: 40px;
    margin-right: 10px;
    margin-left: 10px;
    
}

.pay input[type="radio"] {
    margin: 0; /* Ensure no default margin for radio button */
}

.pay label {
    display: flex;
    align-items: center;
    cursor: pointer;
}

/* Optional: Add a bit of spacing between the icon and text */
.pay .text {
    margin-left: 5px;
}

button[name="capnhat"] {
    width: 80px;
    margin-top: 20px;
    padding: 10px;
    background-color: gray;
    color: #fff;
    border: none;
    cursor: pointer;
    border-radius: 5px;
}


button[name="capnhat"]:hover {
    background-color: #9f897e;
}

button[name="btvocher"] {
    width: 80px;
    margin-top: 20px;
    padding: 10px;
    background-color: gray;
    color: #fff;
    border: none;
    cursor: pointer;
    border-radius: 5px;
}


button[name="btvocher"]:hover {
    background-color: #9f897e;
}

input[name="ma_voucher"] {
    margin-top: 15px;
    width: 200px;
    padding: 9px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 5px;
}

/* Optional: Add some styles for placeholder text */
input[name="ma_voucher"]::placeholder {
    color: #aaa;
}
    /* formttdathang */
    
    h4 {
    font-size: 1.5em; /* Adjust the font size as needed */
    color: #333; /* Set the desired color */
    font-weight: bold; /* Optionally set font weight to bold */
}

.bank h4 {
    margin-bottom: 0;
}
</style>
