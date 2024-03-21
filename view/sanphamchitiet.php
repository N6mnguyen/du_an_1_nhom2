<?php
$html_dm = showdm($dsdm);
extract($spchitiet);
$imgn = IMG_PATH_USER . $ten_hinh;
$html_sp_lienquan = showsp($splienquan);

?>

<div class="containerfull">
    <div class="bgbanner">SẢN PHẨM CHI TIẾT</div>
</div>

<section class="containerfull">
    <div class="container">
        <div class="boxleft mr2pt menutrai">
            <h1>DANH MỤC</h1><br><br>
            <?= $html_dm ?>
            <!-- <a href="#">Cà phê</a>
                <a href="#">Trái cây</a>
                <a href="#">Trà</a>
                <a href="#">Bánh</a> -->
        </div>
        <div class="boxright">
            <h1>SẢN PHẨM CHI TIỂT</h1><br>
            <div class="containerfull mr30 flex__chitiet">
                <!-- ảnh sản phẩm -->
                <div class="col6 img_chitiet_box">
                    <div class="img_to">
                        <img name="ok" class="img__title" src="<?= $imgn ?>" alt="">
                    </div>
                    <div class="box__imgchill">
                        <div class="img__contact" id="img__contact">
                            <img class="img__text" src="<?= $imgn ?>" alt="">
                        </div>
                        <div class="img__contact">
                            <img class="img__text" src="<?= $imgn ?>" alt="">
                        </div class="img__contact">
                        <div class="img__contact">
                            <img class="img__text" src="<?= $imgn ?>" alt="">
                        </div>
                        <div class="img__contact">
                            <img class="img__text" src="<?= $imgn ?>" alt="">
                        </div>
                        <div class="img__contact">
                            <img class="img__text" src="<?= $imgn ?>" alt="">
                        </div>
                    </div>
                </div>
                <!-- phần lựa chọn giá, size, số lượng -->
                <div class="col6 textchitiet sanpham__box">
                    <form action="index.php?pg=addcart" method="post">
                        <!-- name -->
                        <div class="title__sanpham">
                            <h2>TÊN SẢN PHẨM: </h2>
                            <h3><input type="hidden" name="tensp" value="<?= $name ?>">
                                <?= $name ?>
                            </h3>
                        </div>
                        <!-- price -->
                        <div class="title__sanpham">
                            <h2>GIÁ: </h2>
                            <h3><input type="hidden" name="price" value="<?= $price ?>">
                                <span id="total">
                                    <?= number_format($price, 0, ',', '.') ?> VNĐ
                                </span>
                                <?php $gia= $price;?>
                            </h3>

                        </div>
                        <!-- view -->
                        <div class="title__sanpham">
                            <h2>Số sản phẩm:</h2>
                            <h3>
                                <p><span id="quantity">1</span></p>
                            </h3>
                        </div>
                        <!-- soluong -->
                        <div class="title__sanpham">
                            <h2>SỐ LƯỢNG: </h2>
                            <input type="number" id="quantityInput" value="1" step="1" name="soluong" id="" min="1"
                                max="10" class="soluong">
                        </div>
                        <!-- size -->
                        <div class="title__sanpham2">
                            <h2>SIZE(bắt buộc): </h2>
                            <p>Kích thước: <span id="size">S</span></p>
                            
                        <?php 
                            foreach ($bienthe as $dd){
                                extract($dd);
                        ?>        
                                <div class="custom-radio">
                                    <input type="radio" name="size" id="size<?=$kichthuoc?>" value="<?=$tien?>">
                                    <label for="size<?=$kichthuoc?>"><?=$kichthuoc?> + <?=number_format($tien, 0, ',', '.')?> đ</label>
                                </div>
                        <?php    
                            }
                        ?>

                            <!-- <div class="custom-radio">
                                <input type="radio" name="size" id="sizeS" value="0">
                                <label for="sizeS">Nhỏ + 0 đ</label>
                            </div>
                            
                            <div class="custom-radio">
                                <input type="radio" name="size" id="sizeM" value="4000">
                                <label for="sizeM">vừa + 4.000 đ</label>
                            </div>
                            
                            <div class="custom-radio">
                                <input type="radio" name="size" id="sizeL" value="6000">
                                <label for="sizeL">Lớn + 6.000 đ</label>
                            </div> -->
                        </div>
                        <input type="hidden" name="idpro" value="<?= $id ?>">
                        <input type="hidden" name="img" value="<?= $ten_hinh ?>">
                        <div class="click_mua">
                            <button class="addtocart__btn button" name="addcart">THÊM GIỎ HÀNG</button>
                        </div>

                    </form>
                </div>

            </div>
            <hr>

            <div class="motasanpham">
                <h3>Mô Tả Sản Phẩm</h3>
                <?= $mota ?>
            </div>


            <hr>

            <div class="sanphamlienquan">
                <h3>Sản Phẩm Liên Quan</h3>
                <?= $html_sp_lienquan ?>
            </div>
            <hr>


            <div id="binhluan">
                <iframe src="view/binhluan.php?idpro=<?= $id ?>" width="100%" height="500px" frameborder="0"></iframe>
            </div>
            <hr>
        </div>


    </div>
</section>

<script>
    const totalDisplay = document.getElementById("total");
    const quantityDisplay = document.getElementById("quantity");
    const quantityInput = document.getElementById("quantityInput");
    const sizeInputs = document.querySelectorAll('input[name="size"]');
    const sizeDisplay = document.getElementById("size");

    sizeInputs.forEach((input) => {
        input.addEventListener("change", () => {
            sizeDisplay.textContent = input.id.substring(4);
            updatePrice();
        });
    });

    quantityInput.addEventListener("input", () => {
        quantityDisplay.textContent = quantityInput.value;
        updatePrice();
    });

    function updatePrice() {
        let price = <?= $gia ?>; // Giá tiền mặc định là 10,000 VNĐ
        sizeInputs.forEach((input) => {
            if (input.checked) {
                price += parseInt(input.value);
            }
        });

        const quantity = parseInt(quantityInput.value);

        if (!isNaN(quantity) && quantity > 0) {
            const total = price * quantity;
            totalDisplay.textContent = total.toLocaleString("vi-VN") + " VNĐ"; // Hiển thị số tiền theo định dạng tiền tệ Việt Nam
        }
    }


</script>