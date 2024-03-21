<?php 
require_once 'pdo.php';
function insertvoucher($ma_voucher,$gia,$soluong){
    $sql = "INSERT INTO voucher(ma_voucher,giatri, soluong) VALUES (?, ?,?)";
   return pdo_execute($sql,$ma_voucher,$gia,$soluong);
}
function voucherct($idvoucher,$iduser){
    $sql = "INSERT INTO chitietvoucher(id_voucher, id_user) VALUES (?, ?)";
    return pdo_execute_id($sql, $idvoucher, $iduser);
}
function loadvoucher($limit, $limit2){
    $sql=" SELECT voucher.*, COUNT(chitietvoucher.id_ct_voucher) AS so_luong_chitiet
    FROM voucher
    LEFT JOIN chitietvoucher ON voucher.id_voucher = chitietvoucher.id_voucher
    GROUP BY voucher.id_voucher
    ORDER BY voucher.id_voucher DESC
    LIMIT $limit, $limit2";
    return pdo_query($sql);
}
function sotrangvoucher($itemsPerPage){
    $sql = "SELECT COUNT(*) as total FROM voucher WHERE 1";
    $ww = pdo_query($sql);
    foreach ($ww as $a) {
        $total_pages = ceil($a['total'] / $itemsPerPage);
    }
    return $total_pages;
}
function loadvoucherid($idvoucher){
    $sql="SELECT * FROM voucher WHERE id_voucher = $idvoucher";
    return pdo_query($sql);
}
function delvoucher($idvoucher){
    $sql = "DELETE FROM voucher WHERE id_voucher = $idvoucher";
    pdo_query($sql);

}
function updatevoucher($idvoucher, $ma_voucher,$gia, $soluong){
    $sql = "UPDATE voucher SET ma_voucher = ?,giatri=?, soluong = ? WHERE id_voucher = ?";
    pdo_query($sql, $ma_voucher,$gia,$soluong,$idvoucher);
}
?>