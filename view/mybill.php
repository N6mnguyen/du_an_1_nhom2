<?php 
if(isset($_SESSION['s_user'])) {
    // print_r($bill);
    // die();
$html_cart=  show_donhang_user($bill);
}else{
    $html_cart='';
}
?>

<div class="containerfull">
    <div class="bgbanner">Đơn Hàng</div>
</div>

<section class="containerfull">
    <div class="container">
        <div class="col9 viewcart">
            <h1>ĐƠN HÀNG</h1>
            <table class="tableviewcart">
                <tr>
                    <th>STT</th>
                    <th style="width: 155px;">Mã đơn hàng</th>
                    <th>Tên nhận hàng</th>
                    <th>Điện thoại người nhận</th>
                    <th>Địa chỉ người nhận</th>
                    <th>Tổng thanh toán</th>
                    <th>PTTT</th>
                    <th style="width: 122px;">Trạng thái</th>
                    <th>Thao Tác</th>
                </tr>
                <?= $html_cart ?>


            </table>
            
            <?php
            for($i = 1; $i <= $total_pages; $i++) {
                ?>
                <button class="phantrang"><a class="nutphantrang" href='index.php?pg=mybill&page=<?= $i ?>'>
                        <?= $i ?>
                    </a></button>
                <?php
            } ?>
            
        </div>
    </div>
</section>
<style>
    
     .phantrang {
        
        display: inline-block;
        padding: 3px 10px;
        text-decoration: none;
        background-color: #ffedcc;
        color: #fff;
        border: 1px solid #ffedcc;
        border-radius: 5px;
        cursor: pointer;
    }

    .phantrang a {
        color: black;
    }

    .phantrang a:hover {
        color: blue;
        text-decoration: underline;
    }
    .nut{
        float: left;
    }
    .nut2{
        float: right;
    }
    .col9 {
        width: 100%;
        float: left;
    }

    .viewcart {
        margin-bottom: 20px;
    }

    h2 {
        color: #333;
        font-size: 24px;
    }

    .tableviewcart {
        border-collapse: collapse;
        width: 100%;
        color: #333;
        font-family: Arial, sans-serif;
        font-size: 14px;
        text-align: left;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        margin: auto;
        margin-top: 50px;
        margin-bottom: 50px;
    }
    
    .tableviewcart th {
        background-color: #8f7263 !important;
        color: #fff;
        font-weight: bold;
        padding: 10px;
        text-transform: uppercase;
        letter-spacing: 1px;
        border-top: 1px solid #fff;
        border-bottom: 1px solid #ccc;
    }

    .tableviewcart tr:nth-child(even) td {
        background-color: #f2f2f2;
    }

    .tableviewcart tr:hover td {
        /* background-color: #ffedcc; */
    }
    .tableviewcart th{
        border: none !important;

    }
    .tableviewcart td {
        background-color: #fff;
        padding: 10px;
        border: none !important;
        font-weight: bold;
    }
</style>
