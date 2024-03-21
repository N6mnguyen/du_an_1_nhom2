<?php
session_start();
include "dao/pdo.php";
include "dao/danhmuc.php";
include "dao/sanpham.php";
include "dao/giohang.php";
include "dao/user.php";
include "dao/donhang.php";
include "dao/binhluan.php";
include "dao/convnpay.php";

$idToUpdate = $_GET['cart_id'];
$tien = $_GET['tien'];
$soluong = $_GET['soluong'];
foreach ($_SESSION['giohang'] as &$product) {
    if ($product['id'] == $idToUpdate && $product['tien'] == $tien) {
        $product['soluong'] = $soluong;
        break;
    }
}
$voucher=10000;
$thanhtien =$tien-$voucher;
$arr =[];
$arr =[$voucher,$thanhtien];
echo $arr;
