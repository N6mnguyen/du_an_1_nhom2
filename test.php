<?php 
session_start();
print_r($_SESSION['s_user']);
print_r($_SESSION['giohang']);
include "dao/pdo.php";
$a='titdidanphuong';
$idvch;
if (isset($_SESSION['s_user'])) {
$sql ="SELECT voucher.giatri, voucher.id_voucher FROM voucher WHERE voucher.ma_voucher =  ?";
$giavoucher = pdo_query($sql,$a);
foreach($giavoucher as $value){
    $idvch = $value['id_voucher'];
    $gia = $value['giatri'];
    break;
}
$sql1 ="SELECT chitietvoucher.id_ct_voucher FROM chitietvoucher WHERE chitietvoucher.id_voucher = ? AND chitietvoucher.id_user=?";
$check = pdo_query($sql1,$idvch,$_SESSION['s_user']['id']);
// print_r($check);
if ($check!=[]) {
    echo 'Voucher đã sử dụng hoặc không tồn tại!';
}else{
    echo $gia;
}
}
// print_r($giavoucher);
?>