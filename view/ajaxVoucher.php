<?php  
session_start();
include "../dao/pdo.php";
$thanhtien;
$gia;
$sl;
$sl2;
if ($_SESSION['giohang']!=[]) {
    if (isset($_SESSION['s_user'])) {
        $sql ="SELECT voucher.giatri, voucher.id_voucher, voucher.soluong FROM voucher WHERE voucher.ma_voucher =  ?";
        $giavoucher = pdo_query($sql,$_POST['noidung']);
        if ($giavoucher==[]) {
            echo 'Voucher không tồn tại!';
        }else{
            foreach($giavoucher as $value){
                $idvch = $value['id_voucher'];
                $gia = $value['giatri'];
                $sl = $value['soluong'];
                break;
            }
            $sql2 = "SELECT COUNT(*) AS so_voucherchitiet
                        FROM chitietvoucher
                        WHERE chitietvoucher.id_voucher = ?";
            $soluong= pdo_query($sql2,$idvch);
            foreach($soluong as $value){
                $sl2=$value['so_voucherchitiet'];
            }
            if ($sl2<$sl) {
                $sql1 ="SELECT chitietvoucher.id_ct_voucher FROM chitietvoucher WHERE chitietvoucher.id_voucher = ? AND chitietvoucher.id_user=?";
                $check = pdo_query($sql1,$idvch,$_SESSION['s_user']['id']);
                if ($check!=[]) {
                    echo 'Voucher đã được sử dụng!';
                }else{
                    $thanhtien = $_POST['tien']-$gia;
                    $data = $gia.','.$thanhtien.','.$idvch;
                    echo $data;
                }
            }else{
                echo 'Voucher đã hết lượt sử dụng!';
            }
        }
    }
}

?>
