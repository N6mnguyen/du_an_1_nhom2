<?php
require_once 'pdo.php';

function binhluan_insert($noidung,$ngaybl,$idpro,$iduser){
    $sql = "INSERT INTO binhluan(noidung,ngaybl,idpro,iduser) VALUES (?,?,?,?)";
    pdo_execute($sql,$noidung, $ngaybl, $idpro, $iduser );
}

// function binhluan_update($ma_bl, $ma_kh, $ma_hh, $noi_dung, $ngay_bl){
//     $sql = "UPDATE binhluan SET ma_kh=?,ma_hh=?,noi_dung=?,ngay_bl=? WHERE ma_bl=?";
//     pdo_execute($sql, $ma_kh, $ma_hh, $noi_dung, $ngay_bl, $ma_bl);
// }

function binhluan_delete($ma_bl){
    $sql = "DELETE FROM binhluan WHERE id=?";
        pdo_execute($sql, $ma_bl);
}
function countbluser($iduser){
    $sql = "SELECT COUNT(*) as soLuongBinhLuan FROM binhluan WHERE iduser = $iduser";
    return pdo_query($sql);
}
function binhluan_select_all(){
    $sql = "SELECT * FROM binhluan ORDER BY id  DESC";
    return pdo_query($sql);
}

function binhluan_sp($idsp){
    $sql = "SELECT binhluan.id as idbl, binhluan.idpro, binhluan.ngaybl, binhluan.noidung,
    user.id , user.username,user.anh
    FROM binhluan
    INNER JOIN user ON binhluan.iduser = user.id Where binhluan.idpro = $idsp ORDER BY binhluan.id DESC";
    return pdo_query($sql);
}

// function binhluan_select_by_id($ma_bl){
//     $sql = "SELECT * FROM binhluan WHERE ma_bl=?";
//     return pdo_query_one($sql, $ma_bl);
// }

// function binhluan_exist($ma_bl){
//     $sql = "SELECT count(*) FROM binhluan WHERE ma_bl=?";
//     return pdo_query_value($sql, $ma_bl) > 0;
// }
//-------------------------------//
// function binhluan_select_by_hang_hoa($ma_hh){
//     $sql = "SELECT b.*, h.ten_hh FROM binhluan b JOIN hang_hoa h ON h.ma_hh=b.ma_hh WHERE b.ma_hh=? ORDER BY ngay_bl DESC";
//     return pdo_query($sql, $ma_hh);
// }
function checkuserbl($idpro,$iduser){
$sql="SELECT 
b.*, c.*
FROM 
bill b
JOIN 
cart c ON b.id = c.idbill
WHERE 
b.iduser = $iduser
AND c.idpro = $idpro
AND b.id_trangthai = 5;";
return pdo_query($sql);
}